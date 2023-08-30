<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
get_template_part('global-templates/inner-banner');
?>

<section class="infobox-section checklist-infobox content-type-section comman-margin">

    <div class="container">

        <div class="infobox-warp">
            <?php 
            $ppp = 9;
            $counter = 1;
            $current_term = get_queried_object_id();
            
            $posts_args = array(
                'post_type' => 'resource', 
                'post_status' => 'publish', 
                'order' => 'DESC',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'content-type',
                        'field'    => 'term_id',
                        'terms'    => array($current_term),
                        'operator' => 'IN',
                    ),
                ),
            );

            $posts_loop = new WP_Query( $posts_args );

            if( $posts_loop->have_posts() ){ ?>

                <div class="row g-5">

                <?php
                while( $posts_loop->have_posts() ){
                    $posts_loop->the_post();

                    $post_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : DEFAULT_IMG;
                    $post_content = get_the_content();
                    $post_content = strip_tags($post_content);

                    if ( strlen($post_content) > 125 ) {
                        $post_content = substr($post_content, 0, 125); 
                    }
                    ?>
                    <div class="col-md-6 col-xl-4 <?= $counter; ?>" <?= $counter > $ppp ? 'style="display:none;"' : ''; ?> data-pagenumber="resources<?= ceil($counter/$ppp); ?>">
                        <div class="info-box">
                            
                            <div class="info-description-wrap">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none"><h5><?php the_title(); ?></h5></a> 
                                <div class="info-description">
                                    <p><?= $post_content . '...'; ?></p>
                                </div>
                                <a class="btn navyblue-btn" href="<?php the_permalink(); ?>">Read More</a>                        
                            </div>
                        </div>
                    </div>
                <?php $counter++; 
                } ?>                
                </div>
            <?php }

            if( $posts_loop->found_posts > $ppp ){ ?>
                <div class="text-center my-5 py-3">
                    <a href="javascript:void(0);" class="btn blue-btn resources-load-more navyblue-btn" data-pagenumber="1">Load More</a>
                </div>
            <?php } ?>
                
            <script>
                // Script to load more resources
                jQuery(document).on('click', '.resources-load-more', function(e){
                    e.preventDefault();
                    var pagenumber = parseInt(jQuery(this).attr('data-pagenumber'));
                    pagenumber = parseInt(pagenumber+1);
                    jQuery('[data-pagenumber="resources'+ pagenumber +'"]').show();
                    jQuery(this).attr('data-pagenumber', pagenumber);
                    pagenumber = parseInt(pagenumber+1);
                    
                    if( jQuery('[data-pagenumber="resources'+ pagenumber +'"]').length == 0 ){
                        jQuery(this).remove();
                    }
                });
            </script>

            <?php wp_reset_query(); ?>
        </div>
    </div>
</section>

<?php 
get_footer();
?>