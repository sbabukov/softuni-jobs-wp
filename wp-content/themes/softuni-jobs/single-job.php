<?php get_header(); ?>

<?php if( have_posts()): ?>
	
	<?php while( have_posts()): ?>
		
		<?php the_post(); ?>
		
		
		<div class="job-single">
			<main class="job-main">
				<div class="job-card">
					<div class="job-primary">
						<header class="job-header">
							<h1 class="job-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<div class="job-meta">
								<a class="meta-company" href="#"><?php echo softuni_display_single_term( get_the_ID(), 'company'); ?></a>
								<span class="meta-date">Posted on <?php echo get_the_date(); ?></span>
								
								<!-- Показва мета дата за пост визит -->
								<span class="meta-date">Job visits <?php echo get_post_meta(get_the_ID(), 'visit_count', true); ?></span>
							</div>
							<div class="job-details">
								<span class="job-location"><?php echo softuni_display_single_term( get_the_ID(), 'location'); ?></span>
								<span class="job-type"><?php the_author(); ?></span>
							</div>
						</header>

						<div class="job-body">
							<!-- call dynamic post body -->
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</main>
			<aside class="job-secondary">
				<div class="job-logo">
					<div class="job-logo-box">

					<!-- If have not post image, will load default image apple -->
					<?php if (has_post_thumbnail()) : ?>
						<?php the_post_thumbnail('job-thumbnail'); ?>
					<?php else : ?>
						<img src="https://i.imgur.com/ZbILm3F.png" alt="default image">
					<?php endif; ?>
					</div>
				</div>

				<!-- тук слагаме бутон за лайкване -->
				<!-- това: (<?php echo get_post_meta( get_the_ID(), 'likes', true) ?>) показва лайковете до бутона за лайкване -->
				<a id="<?php echo get_the_ID(); ?>" class="like-button" href="#">Like (<?php echo get_post_meta( get_the_ID(), 'likes', true) ?>)</a> 
				
				<a href="#" class="button button-wide">Apply now</a>
				<a href="#">apple.com</a>
			</aside>
		</div>

		<h2 class="section-heading">Other jobs from the company:</h2>
		
		<!-- get_the_ID() в контекса е id на текущия пост -->
		<?php echo softuni_display_other_jobs_company( get_the_ID() ); ?>
		
			<!--Викаме функцията за броене на визитори от functions.php  -->
		<?php softuni_update_visit_count(get_the_ID()); ?>
			
	<?php endwhile; ?>
<?php endif; ?>


		
<?php get_footer(); ?>