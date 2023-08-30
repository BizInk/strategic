<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

$error_button = get_sub_field('error_button');
?>

<?php				
		get_template_part( 'global-templates/inner-banner'); 
?>

<div class="wrapper" id="error-404-wrapper">
  <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">
    <div class="row">
      <div class="col-md-12 content-area" id="primary">
        <main class="site-main" id="main">
          <section class="page-not-found text-center">
            <div class="container">
            <?php if(get_field('404_title','option')) { ?>
               <h1><?php echo get_field('404_title','option'); ?></h1>
               <?php } ?>  
               <?php if(get_field('404_sub_title','option')) { ?>
               <h2><?php echo get_field('404_sub_title','option'); ?></h2>
               <?php } ?> 
               <?php if(get_field('404_description','option')) { ?>
               <p><?php echo get_field('404_description','option'); ?></p>
               <?php } ?> 

               <?php $error_button = get_field('error_button','option'); if($error_button['title']) { ?>
	            <a href="<?php echo $error_button['url']; ?>" class="btn navyblue-btn mt-4"><?php echo $error_button['title']; ?></a>
<?php } ?>

            </div>
          </section>
        </main><!-- #main -->
      </div><!-- #primary -->
    </div><!-- .row -->
  </div><!-- #content -->
</div><!-- #error-404-wrapper -->

<?php
get_footer();
