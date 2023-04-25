<?php
/*
 * Plugin Name:       SoftUni Jobs
 * Plugin URI:        https://softuni.bg
 * Description:       Our basic plugin for jobs.
 * Version:           0.1
 * Requires at least: 5.0
 * Requires PHP:      8.0
 * Author:            SoftUni
 * Author URI:        https://softuni.bg
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       softuni-jobs
 * Domain Path:       /languages
 */

// var_dump( 'Hello my first plugin SoftUni-Jobs' );

// Load custom post types
// require because is required
require 'cpt-jobs.php';

// Load functions.php 
include 'functions.php';

// Load jobs-page.php 
// include 'templates/jobs-page.php';