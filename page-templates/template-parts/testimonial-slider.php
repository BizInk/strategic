<?php
$new_testimonial_title = get_sub_field('new_testimonial_title');
$new_testimonial_content = get_sub_field('new_testimonial_content');
$new_testimonial_button = get_sub_field('new_testimonial_button');
$new_testimonial_testimonials = get_sub_field('new_testimonial_testimonials');
$new_testimonial_bg = get_sub_field('new_testimonial_bg');
?>

<section class="client-say-section comman-padding" style="background-image:url(<?php echo $new_testimonial_bg; ?>);">
	<div class="client-left-content">
		<div class="editor-design">
			<h2><?= $new_testimonial_title; ?></h2>
			<?= $new_testimonial_content; ?>
		</div>
		<a href="<?= $new_testimonial_button['url']; ?>" class="btn white-btn" target="<?= $new_testimonial_button['target']; ?>"><?= $new_testimonial_button['title']; ?> <img src="<?php  echo get_stylesheet_directory_uri(); ?>/images/arrow-right.svg" alt=""></a>
	</div>

	<?php if( !empty($new_testimonial_testimonials) ){ ?>

		<div class="client-right-content">
			<div class="client-review-slider">
				<?php foreach( $new_testimonial_testimonials as $new_testimonial_testimonial ){
					
					$reviewer_name = get_field('reviewer_name', $new_testimonial_testimonial);
					$reviewer_designation = get_field('reviewer_designation', $new_testimonial_testimonial);
					$review_content = get_field('review_content', $new_testimonial_testimonial);
					$rating_count = get_field('rating_count', $new_testimonial_testimonial); ?>

					<div class="review-box">
						<div class="review-box-inner-wrap">
							<div class="editor-design">
								<?php if( !empty($review_content) ){ ?>

									<a href="<?= get_the_permalink($new_testimonial_testimonial); ?>">
										<p><?= $review_content; ?></p>
									</a>
								<?php } ?>
							</div>
							<div class="d-flex align-items-center justify-content-between flex-wrap">
								<div class="author-details">
									<?php if( !empty($reviewer_name) ){ ?>
										
										<h5><?= $reviewer_name; ?></h5>
									<?php }

									if( !empty($reviewer_designation) ){ ?>
										
										<span><?= $reviewer_designation; ?></span>
									<?php } ?>
								</div>

								<?php if( !empty($rating_count) ){ ?>

									<div class="rate">
										<?php bage_star_rating($rating_count); ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>				     
			</div>
		</div>
	<?php } ?>
</section>