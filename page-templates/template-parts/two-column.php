<?php
$general_settings = get_sub_field('general_settings');
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){

	$general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){

	$general_class .= ' comman-margin';
}

if( have_rows('column_section') ):

	while( have_rows('column_section') ): the_row(); ?>

		<section class="two-col-section<?= $general_class; ?>" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/bg-shape-reverse.jpg);">
			<div class="container">

				<?php
				$column_image_position = '';
				$column_image_gallery = get_sub_field('column_image_gallery');

				if(get_sub_field('column_image_position') == 'right'){

				$column_image_position = 'flex-md-row';
				} elseif(get_sub_field('column_image_position') == 'left'){

				$column_image_position = 'flex-md-row-reverse';
				} ?>

				<div class="row align-item-center <?php echo $column_image_position; ?> flex-column-reverse">
					<div class="col-md-6 col-left mb-5 mb-md-0">
						<div class="col-content default-content">
							<?php if(get_sub_field('column_small_title')) { ?>

								<h5 class="dark"><?php echo get_sub_field('column_small_title'); ?></h5>
							<?php }

							if(get_sub_field('column_hero_title')) { ?>

								<h2><?php echo get_sub_field('column_hero_title'); ?></h2>
							<?php }

							if(get_sub_field('column_hero_description')) {

								echo get_sub_field('column_hero_description');
							}

							$column_hero_button = get_sub_field('column_hero_button');
							if( !empty($column_hero_button)){
								if($column_hero_button['title']) {
									?>
									<a href="<?php echo $column_hero_button['url']; ?>" target="<?php echo $column_hero_button['target']; ?>" class="btn navyblue-btn mt-3"><?php echo $column_hero_button['title']; ?><img src="<?php  echo get_stylesheet_directory_uri(); ?>/images/arrow-right.svg" alt=""></a>
									<?php
								} 
							}
							?>
						</div>
					</div>

					<div class="col-md-6 col-right mb-5 mb-md-0">

						<?php
						if(!empty($column_image_gallery)){
							if( $column_image_gallery == 'image' ){
								if(get_sub_field('column_hero_image')) { ?>
									<img src="<?php echo get_sub_field('column_hero_image'); ?>" class="img-fluid" alt="">
								<?php }
							}
							else if( $column_image_gallery == 'gallery' && have_rows('column_hero_gallery') ){
								?>
								<div class="two-col-slider">
									<?php while( have_rows('column_hero_gallery') ){
										the_row();

										$column_hero_gallery_image = get_sub_field('column_hero_gallery_image');
										if( !empty($column_hero_gallery_image['url']) ){ ?>
											<div class="slide"> 
												<div class="child-element">
													<img src="<?php echo $column_hero_gallery_image['url']; ?>" alt="<?php echo $column_hero_gallery_image['alt']; ?>"> 
												</div>
											</div>
										<?php }
									} ?>
								</div>
							<?php
							}
					}
					?>
					</div>
				</div>
			</div>
		</section>
	<?php endwhile; ?>
<?php endif; ?>