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
$tesimonials_post_obj = get_sub_field("tesimonials_post_obj");

?>

<section class="testimonial-list-section comman-padding" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/testimonial-bg-img.jpg);">
  <div class="container">
    <?php
        if($tesimonials_post_obj):
          $testimonial_count = 0;
          foreach( $tesimonials_post_obj as $post ): 
          // Setup this post for WP functions (variable must be named $post).
          setup_postdata($post);
          $isEven = $testimonial_count % 2 ? 'flex-row-reverse' : '';

          $reviewer_image = get_field("reviewer_image");
          $reviewer_name = get_field("reviewer_name");
          $reviewer_designation = get_field("reviewer_designation");
          $review_content = get_field("review_content");
          $rating_count = get_field("rating_count");
          $reviewer_youtube = get_field("reviewer_youtube");
          ?>
          <div class="row <?php echo $isEven; ?>">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <div class="client-avtar-wrap">
                    <div class="client-avtar-inner-wrap">
                        <a href="<?php the_permalink() ?>"><img src="<?php echo $reviewer_image; ?>" class="img-fluid" alt=""></a>
                    </div>
                </div>                    
            </div>
            <div class="col-md-6 col-lg-7 col-xl-8">
                <div class="client-word">                
                    <div class="editor-design">
                         <?php echo $review_content; ?>
                    </div>
                    <a href="<?php the_permalink() ?>"><h6><?php echo $reviewer_name; ?></h6></a>
                    <p><?php echo $reviewer_designation; ?></p>
                </div>
            </div>
          </div>   

          <?php
          $testimonial_count++;
          endforeach;

          wp_reset_postdata();
          
      endif;
    ?>
  </div>
</section>