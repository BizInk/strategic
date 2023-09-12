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
get_template_part('global-templates/inner-banner');

// 'order'  => 'ASC',
// 'orderby' => 'date',
$posts_args = array(
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'post_type' => 'weekly-digest',
	'cat' => get_queried_object()->term_id,
);

$posts_loop = new WP_Query( $posts_args );

if( $posts_loop->have_posts() ){ ?>

    <section class="four-col-team-section comman-padding">      
        <div class="container">
            <div class="team-wrap">
                <div class="row g-lg-5">

                    <?php 
                    $posts_counter = 1;
                    $ppp = 9;

                    while ( $posts_loop->have_posts() ) {
                        $posts_loop->the_post();

                        $post_content = get_the_content();
                        $post_content = strip_tags($post_content);

                        if ( strlen($post_content) > 100 ) {
                            $post_content = substr($post_content, 0, 100); 
                        } 

                        $post_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : get_stylesheet_directory_uri() . '/images/default.jpg';
                        ?>

                        <div class="col-md-6 col-xl-4 team-member" <?= $posts_counter > $ppp ? 'style="display:none;"' : ''; ?> data-pagenumber="posts<?= ceil($posts_counter/$ppp); ?>">
                            <div class="team-member-wrap">
                                <?php if(has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>" class="member-img">
                                    <img src="<?= $post_image; ?>" alt="post-img">
                                </a>
                                <?php endif; ?>
                                <div class="member-details">
                                    <a href="<?php the_permalink(); ?>">
                                        <h4 class="member-name"><?php the_title(); ?></h4>
                                    </a>

                                    <p><?= $post_content; ?></p>
                                    <a href="<?php the_permalink(); ?>" class="readmore">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php $posts_counter++;
                        } ?>
                    </div>
                    
                    <script>
                        // Script to load more posts
                        jQuery(document).on('click', '.posts-loadmore', function(e){
                            e.preventDefault();

                            var pagenumber = parseInt(jQuery(this).attr('data-pagenumber'));
                            pagenumber = parseInt(pagenumber+1);

                            jQuery('[data-pagenumber="posts'+ pagenumber +'"]').show();

                            jQuery(this).attr('data-pagenumber', pagenumber);

                            pagenumber = parseInt(pagenumber+1);
                            
                            if( jQuery('[data-pagenumber="posts'+ pagenumber +'"]').length == 0 ){

                                jQuery(this).remove();
                            }
                        });
                    </script>
                </div>
            </div>

            <?php if( $posts_loop->found_posts > $ppp ){ ?>
                        
                <div class="d-flex justify-content-center">         
                    <a href="javascript:void(0);" class="btn posts-loadmore" data-pagenumber="1">Load More</a>
                </div>
            <?php }
            wp_reset_query(); ?>
        </div>
    </section>
<?php
}
get_footer();
