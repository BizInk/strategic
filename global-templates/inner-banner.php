<?php
$banner_image = get_field('inner_banner_image'); 

if( !$banner_image || empty($banner_image) ){

	$banner_image = get_field('inner_banner_image', 'options');
}

$banner_title = get_field('inner_banner_title');
if( !$banner_title || empty($banner_title) ){

	$banner_title = get_field('inner_banner_title', 'options');
}

$banner_subtitle = get_field('inner_banner_content');

// If testimonial single page
if( is_singular('testimonial') ){

	$banner_image = get_field('testimonials_banner', 'options');
	$banner_title = get_the_title();
	$banner_subtitle = 'Testimonial';
}

// If post details page
if( is_singular('post') ){

	$banner_title = get_the_title();
	$banner_subtitle = get_the_author() . ' | ' . get_the_date('d M Y');
}

// If taxonomy archive page
if( is_tax() ){

	$term = get_queried_object();

	$banner_title = $term->name;
	$banner_subtitle = '';
}

// If search results page
if( is_search() ){

	$search_term = isset($_GET['s']) ? $_GET['s'] : '';
	$banner_title = 'Search results';
	
	if( !empty($search_term) ){

		$banner_title .= ' for "'. $search_term .'"';
	}

	$banner_subtitle = '';
}

// If archive page
if( is_archive() ){

	$banner_title = get_queried_object()->name;
	$banner_subtitle = '';
} ?>

<section class="call-to-action-section inner-banner-section overlay bg-color comman-padding" style="background-image:url(<?php echo $banner_image; ?>);">
	<div class="full-width-wysiwyg text-center">
		<div class="container">
			<div class="editor-design">

				<?php if( !empty($banner_title) ){ ?>

					<h1><?php echo $banner_title; ?></h1>
				<?php }

				if( !empty($banner_subtitle) ){ ?>

					<p><?php echo $banner_subtitle; ?></p>
				<?php } ?>
			</div>
		</div>
	</div>	
</section>