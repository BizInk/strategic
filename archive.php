<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
get_template_part('global-templates/inner-banner'); ?>

    <section class="blog-listing-section comman-padding" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/bg-shape.jpg);">
	    <div class="container">

	        <div class="blog-list-wrap blog-posts-cont">
	           Loading...
	        </div>
	    </div>
	</section>
<?php 
get_footer(); 