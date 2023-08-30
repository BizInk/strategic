<?php
/**
* The template for displaying all single posts
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
						get_template_part( 'loop-templates/content', 'single' );
					}
					get_template_part( 'global-templates/right-sidebar-check' );
					?>
				</main><!-- #main -->
			</div>
			<!-- Do the right sidebar check -->

		</div><!-- .row -->

		<?php 
		$related_posts = new WP_Query( array( 'category__in' => wp_get_post_categories(get_the_id()), 'numberposts' => 3,'post_type' => 'post', 'post__not_in' => array(get_the_id()) ) );

		if( $related_posts->have_posts() ){ ?>

			<div class="blog-listing-section">
				<div class="container">
				<h2><?php _e('Related Post','strategic'); ?></h2>
					<div class="blog-list-wrap">
						<div class="row g-lg-5">

							<?php while( $related_posts->have_posts() ){
							$related_posts->the_post();

							$post_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : DEFAULT_IMG; ?>

							<div class="col-md-6 col-xl-4 blog">
								<div class="blog-inner-wrap">
									<div class="blog-img">
										<a href="<?php the_permalink(); ?>"><img src="<?= $post_image; ?>" alt="member-img"></a>
									</div>
									<div class="blog-details">
										<div class="meta">
											<span class="author"><?php _e('Posted by','strategic'); ?> <?php the_author(); ?></span> <span class="posted-on"><?php the_date('d M Y'); ?></span>
										</div>
										<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
										<div class="description">
											<?php the_excerpt(); ?>
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