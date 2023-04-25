<?php

/**
 * Jobs enqueue
 */
function softuni_enqueue_scripts() {
	wp_enqueue_script( 'softuni-script', plugins_url( 'assets\scripts\scripts.js', __FILE__ ), array( 'jquery' ), 1.1 );
	wp_localize_script( 'softuni-script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
 }
add_action( 'wp_enqueue_scripts', 'softuni_enqueue_scripts' );

// пхп часта от презентацията, функцията която се грижи за лайковете
function softuni_job_like() {
	$job_id = esc_attr( $_POST['job_id'] );
	$like_number = get_post_meta( $job_id, 'likes', true );

    if (empty( $like_number )) {
        update_post_meta( $job_id, 'likes', 1 ); // това 1 е xардкоднато, защото при празни лайк нъмбър, да започне вече с 1
    } else {
        $like_number = $like_number +1;
        update_post_meta( $job_id, 'likes', $like_number );
    }
    // var_dump($like_number);
	// update_post_meta( $job_id, 'votes', $upvote_number + 1 );

    // добра практика е да се слага wp_die() за да прекрати изпълнението на ajax тук, за да може логиката да си продължи. 
    wp_die();
}

add_action( 'wp_ajax_nopriv_softuni_job_like', 'softuni_job_like' );
add_action( 'wp_ajax_softuni_job_like', 'softuni_job_like' );



/**
 * Display Single Post Term
 *
 * @param integer $post_id
 * @param [type] $taxonomy
 * @return void
 */
function softuni_display_single_term( $post_id, $taxonomy){
    
    // подсигуряваме се, че винаги подаваме $post_id
    if ( empty( $post_id ) || empty( $taxonomy )) {
        return;
    }
    
    $terms = get_the_terms( $post_id, $taxonomy);
    
    $output = '';
    // check $terms is not empty and $terms is array
    if ( !empty( $terms ) && array( $terms) ) {
        foreach ($terms as $term ) {
            $output .= $term->name . ', ';
        }

    }
    // да се подсигурим, че винаги връща $output, дори да е празен масив
    return $output;
}

/**
 * Display related jobs from their category
 *
 * @param [type] $post_id
 * @return void
 */
function softuni_display_related_jobs( $post_id ){

}

/**
 * Display other jobs from their company
 *
 * @param [type] $post
 * @return void
 */
function softuni_display_other_jobs_company( $jobs_id ){
    // проверка ако $jobs_id е празно - дали има постове, няма значение името на променливата
    if ( empty( $jobs_id ) ){
        return;
    }
    // масив с аргументите като на custom post type
    $jobs_args = array(
        'post_type'         => 'job',
        'orderby'           => 'name',
        'post_status'       => 'publish',
        'posts_per_page'    => 2,
        // @TODO: set a taxonomy query
    );

    // правим си wp query
    $jobs_query = new WP_Query( $jobs_args );
    
    // var_dump( $jobs_query );
    if (! empty( $jobs_query )) {
        ?>
            <ul class="jobs-listing">
                <?php foreach( $jobs_query->posts as $job ) {?>
                    <!-- <?php var_dump( $job); ?> -->
                <li class="job-card">
                    <div class="job-primary">

                        <!-- post_title го виждаме в куерито като се вардъмпне -->
                        <h2 class="job-title"><a href="#"><?php echo $job->post_title; ?></a></h2>
                        
                        <div class="job-meta">
                            <a class="meta-company" href="#">Company Awesome Ltd.</a>
                            <span class="meta-date">Posted 14 days ago</span>
                        </div>
                        <div class="job-details">
                            <span class="job-location">The Hague (The Netherlands)</span>
                            <span class="job-type">Contract staff</span>
                        </div>
                    </div>
                    <div class="job-logo">
                        <div class="job-logo-box">
                            <img src="https://i.imgur.com/ZbILm3F.png" alt="">
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        <?php
    }
}

/**
 * Display current username if user logged in
 *
 * @return void
 */
function softuni_display_username() {
    // is logged user
    $output = '';

    if ( is_user_logged_in() == true ) {
        $current_user = wp_get_current_user();
        $user_display_name = $current_user->data->display_name;
        // var_dump( $user_display_name ); 
        $output = ' Hello, '. $user_display_name . ', enjoy the article </br>';
    } else {
        $output = ' Please, logged in </br>' ;
    }
    return $output;
}
// first argument is name of shortcode, secund argument is current function
add_shortcode( 'display_username', 'softuni_display_username' );

/**
 * display_word_count -> word counting
 *
 * @return void
 */
function softuni_display_post_word_count( $atts ) {
    // винаги залагаме променлива, която да връща празен стринг, защото
    $output = '';
    $word_count = 0;
    $post_id = '';

    $attributes = shortcode_atts( array(
		'post_id' => '',
    ), $atts );

    // var_dump( $attributes);
    
    // дали потребителят е въвел атрибут в шорткода
    if( ! empty( $attributes['post_id']) ) {
        $post_id = $attributes['post_id'];
        // взимаме съдържанието на поста, който подаваме
        $post = get_post($attributes['post_id']);
        if(! empty($post)) {
            $post_content = $post->post_content;
            $word_count = str_word_count( $post_content);
            var_dump($word_count);
        }
    } else {
        $output = ' You must add a post attribute';
    }
    if( ! empty($word_count)) {
        $output = ' The number of words for the Post ID '. $post_id . ' is ' . $word_count;
    }
    return $output;
}
add_shortcode( 'display_post_word_count', 'softuni_display_post_word_count');


/**
 * function for update visit count
 *
 * @return void
 */
function softuni_update_visit_count( $post_id = 0){
    if( empty($post_id) ){
        return;
    }
    // взима постмета данните, подаваме постайди на метата 'visit_count' 
    $visit_count = get_post_meta( $post_id, 'visit_count', true);
    
    if( ! empty( $visit_count )) {
        $visit_count ++;
        
        // обновяваме постметата
        update_post_meta( $post_id, 'visit_count', $visit_count );
    } else {
        update_post_meta( $post_id, 'visit_count', 1 );

    }
}