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
	$post_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : DEFAULT_IMG; ?>

	<div class="feature-img">
		<img src="<?= $post_image; ?>">
	</div>
	<div class="entry-header"> 
		<div class="entry-meta">
			<span class="byline">Posted by<span class="author vcard"> <?php the_author(); ?></span></span>
			<span class="posted-on"><?php the_date('d M Y'); ?></span>
		</div><!-- .entry-meta -->

    </div>

	<div class="entry-content default-content">

		<?php the_content(); ?>

	</div><!-- .entry-content -->	

</article><!-- #post-## -->