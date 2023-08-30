<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php
	$post_image = get_the_post_thumbnail_url();

	if( !empty($post_image) ){ ?>

		<div class="feature-img">
			<img src="<?= $post_image; ?>">
		</div>
	<?php } ?>

	<div class="entry-content default-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->	

</article><!-- #post-## -->