<?php
$general_settings = get_sub_field('general_settings'); 
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){
  
  $general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){
  
  $general_class .= ' comman-margin';
}

$testimonial_section_title = get_sub_field('testimonial_section_title'); 

$testimonial_args = array(
    'post_type' => 'testimonial',
    'posts_per_page'  => -1,
    'order' => 'DESC',
    'post_status' => 'publish',
); 

$testimonial_query = new WP_Query($testimonial_args);
 
if ( $testimonial_query->have_posts() ) {
?>
  <section class="testimonial-section<?= $general_class; ?>">
    <div class="full-width-wysiwyg text-center">   
      <div class="container">
        <div class="editor-design">

          <?php if( !empty($testimonial_section_title) ){ ?>
            
            <h2><?= $testimonial_section_title; ?></h2>                     
          <?php } ?>
        </div>
      </div>
    </div>   

    <div class="container">
      <div class="testimonial-full-wrapper">
        <div class="testimonial-bg">      
        </div>
        <div class="testimonial-slider">
          <?php while ( $testimonial_query->have_posts() ) {

                  $testimonial_query->the_post();

                  $reviewer_image = get_field('reviewer_image');
                  $reviewer_name = get_field('reviewer_name');
                  $reviewer_designation = get_field('reviewer_designation');
                  $review_content = get_field('review_content');
                  $rating_count = get_field('rating_count');
                  $reviewer_youtube = get_field('reviewer_youtube');
                  ?>

            <div class="testimonial-slide">
              <div>
                <div class="video-part">
                  
                  <?php if( !empty($reviewer_image) ){ ?>

                    <a href="<?= $reviewer_youtube; ?>" target="" data-fancybox> <img src="<?php echo wp_get_attachment_url($reviewer_image); ?>" alt="client-video"></a>
                  <?php } ?>               
                </div>
                <div class="client-text-wrap">

                  <?php if( !empty($reviewer_name) ){ ?>

                    <h3><?= $reviewer_name; ?></h3>
                  <?php }

                  if( !empty($reviewer_designation) ){ ?>

                    <span>(<?= $reviewer_designation; ?>)</span>
                  <?php }

                  if( !empty($review_content) ){ ?>

                    <p><?= $review_content; ?></p>
                  <?php } ?>

                  <a href="<?php the_permalink(); ?>">READ MORE</a>
                  <div class="rate">
                    <?php bage_star_rating($rating_count); ?> 
                  </div>
                  <div class="quote">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/quote-right.png" alt="quote-right">                  
                  </div>
                </div>
              </div>
            </div>
          <?php }
          wp_reset_query(); ?> 
        </div> 
      </div>
    </div>
  </section>
<?php } ?>