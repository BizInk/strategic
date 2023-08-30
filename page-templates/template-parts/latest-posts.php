<?php 
$general_settings = get_sub_field('general_settings'); 
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){
  
  $general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){
  
  $general_class .= ' comman-margin';
}

$latest_posts_title = get_sub_field('latest_posts_title');
$latest_posts_background_image = get_sub_field('latest_posts_background_image');

$latest_posts_args = array(
    'post_type' => 'post',
    'posts_per_page'  => 3,
    'order' => 'DESC',
    'post_status' => 'publish',
); 

$latest_posts_query = new WP_Query($latest_posts_args);

if ( $latest_posts_query->have_posts() ) {
   ?>
   <section class="blog-listing-section<?= $general_class; ?>"> 
    <div class="half-bg" style="background-image: url(<?= $latest_posts_background_image; ?>)">
    </div>
    <div class="full-width-wysiwyg text-center">       
        <div class="editor-design">       

            <?php if( !empty($latest_posts_title) ){ ?>      

                <h2><?= $latest_posts_title; ?></h2> 
            <?php } ?>
        </div>        
    </div>
    <div class="container">   
        <div class="blog-list-wrap">
            <div class="row g-lg-5">
                <?php while ( $latest_posts_query->have_posts() ) {
                    $latest_posts_query->the_post(); 

                    $excerpt = get_the_excerpt();
                    $latest_posts_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : DEFAULT_IMG; ?>

                    <div class="col-md-6 col-xl-4 blog">
                        <div class="blog-inner-wrap">
                            <a href="<?php the_permalink(); ?>" class="blog-img d-inline-block">
                                <img src="<?= $latest_posts_image; ?>" alt="member-img">
                            </a>
                            <div class="blog-details">
                                 <a href="<?php the_permalink(); ?>">
                                    <h4><?php the_title(); ?></h4>
                                </a>
                                <?php if( !empty($excerpt) ){ ?>

                                    <p><?php echo wp_trim_words($excerpt, 15, ''); ?>
                                    </p>
                                <?php } ?>
                                    <a href="<?php the_permalink(); ?>" class="readmore">Read More <img src="<?php  echo get_stylesheet_directory_uri(); ?>/images/arrow-right.svg" alt=""></a>                                
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