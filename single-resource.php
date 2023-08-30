<?php
/**
* The template for displaying all single resource
*
* @package Understrap
*/
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();

$container = get_theme_mod( 'understrap_container_type' );
get_template_part('global-templates/inner-banner'); ?>

<div class="wrapper" id="single-wrapper" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/bg-shape.jpg);">
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
		<div class="row justify-content-between">
			<div class="col-md-12 col-lg-7 col-xl-8">

				<!-- Do the left sidebar check -->
				<main class="site-main" id="main">
					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'loop-templates/content', 'resource' );
					}
					get_template_part( 'global-templates/right-sidebar-check' );
					?>
				</main><!-- #main -->
			</div>
			<!-- Do the right sidebar check -->

		</div><!-- .row -->

		<?php 
		$content_topics = get_the_terms( get_the_id(), 'content-topic' );
		$content_types = get_the_terms( get_the_id(), 'content-type' );

		$related_args = array(
			'posts_per_page' => 3,
			'post_type' => 'resource',
			'post__not_in' => array(get_the_id()),
			'tax_query' => array(
				'relation' => 'OR',
			),
		);

		$content_topics_arr = array();
		$content_types_arr = array();

		if( !empty($content_topics) ){

			foreach( $content_topics as $content_topic ){

				$content_topics_arr[] = $content_topic->term_id;
			}
		}

		if( !empty($content_types) ){

			foreach( $content_types as $content_type ){
				
				$content_types_arr[] = $content_type->term_id;
			}
		}

		if( !empty($content_topics_arr) ){

			$related_args['tax_query'][] = array(
					'taxonomy' => 'content-topic',
					'terms' => $content_topics_arr,
					'field' => 'id',
					'operator' => 'IN'
				);
		}

		if( !empty($content_types_arr) ){

			$related_args['tax_query'][] = array(
					'taxonomy' => 'content-type',
					'terms' => $content_types_arr,
					'field' => 'id',
					'operator' => 'IN'
				);
		}

		$related_posts = new WP_Query($related_args);

		if( $related_posts->have_posts() ){ ?>

			<div class="blog-listing-section">
				<div class="container">
				<h2><?php _e('Related Resources','strategic'); ?></h2>
					<div class="blog-list-wrap">
						<div class="row g-lg-5">

							<?php while( $related_posts->have_posts() ){
							$related_posts->the_post();

							$post_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : DEFAULT_IMG; ?>

							<div class="col-md-6 col-xl-4 blog">
								<div class="blog-inner-wrap">
									<div class="blog-img">
										<a href="<?php the_permalink(); ?>"><img src="<?= !empty($post_image) ? $post_image : DEFAULT_IMG; ?>" alt="resource-img"></a>
									</div>
									<div class="blog-details">
										<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
										<div class="description">
											<?php echo substr(get_the_excerpt(), 0, strpos(get_the_excerpt(), '<p>')); ?>
										</div>
										<a href="<?php the_permalink(); ?>" class="readmore"><?php _e('Read More','strategic'); ?><img src="<?= get_stylesheet_directory_uri(); ?>/images/arrow-right.svg" alt=""></a>
									</div>
								</div>
							</div>
							<?php }
							wp_reset_query(); ?>

						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div><!-- #content -->				
</div><!-- #single-wrapper -->
<?php
get_footer();