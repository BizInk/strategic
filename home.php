<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
get_template_part('global-templates/inner-banner');
$container = get_theme_mod('understrap_container_type');
$path = get_template_directory_uri();

$categories = get_terms([
  'taxonomy' => 'category', 
  'hide_empty' => true, 
]);

?>
<section class="blog-listing-section comman-padding" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/bg-shape.jpg);">
    <div class="container">

          <?php if( !empty($categories) ){ ?>

          <div class="filter-wrap">
              <h4>Select Category</h4>
              <span class="d-flex justify-content-between align-items-center d-md-none dropdown">Select</span>
              <ul>
                <li class="active" data-cat="">ALL</li>
                <?php foreach( $categories as $category ){ ?>
                  
                  <li data-cat="<?= $category->term_id; ?>"><?= $category->name; ?></li>
                <?php } ?>
              </ul>
          </div>
        <?php } ?>

        <div class="blog-list-wrap blog-posts-cont">
           Loading...
        </div>
    </div>
</section>

<?php
get_footer();
?>