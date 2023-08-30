<?php
/**
 * Partial template for content in page.php
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content ">
	  <div class="default-content editor-design">  
			<?php
			the_content();
			understrap_link_pages();
			?>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
