<?php
$general_settings = get_sub_field('general_settings');
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){

	$general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){

	$general_class .= ' comman-margin';
}

$three_col_title = get_sub_field('three_col_title');
$three_col_description = get_sub_field('three_col_description');

if( have_rows('three_col_images') ){ ?>

	<section class="about-you-section<?= $general_class; ?>">
		<div class="full-width-wysiwyg text-center">
			<div class="container">
				<div class="editor-design">
					<?php if( !empty($three_col_title) ){ ?>
						
						<h2><?= $three_col_title; ?></h2>
					<?php }
					
					echo $three_col_description; ?>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="team-wrap">
				<div class="row g-lg-5">
					<?php while( have_rows('three_col_images') ){
						the_row();

						$three_col_image = get_sub_field('three_col_image');
						$three_col_title = get_sub_field('three_col_title');
						$three_col_subtitle = get_sub_field('three_col_subtitle');
						$three_col_button = get_sub_field('three_col_button');

						if( !empty($three_col_image['url']) ){ ?>

							<div class="col-md-6 col-lg-4 team-member">
								<div class="team-member-wrap">
									<div class="member-img">
										<?php if( !empty($three_col_button['url']) ){ ?>
											
											<a href="<?= $three_col_button['url']; ?>">
										<?php } ?>
												<img src="<?php echo $three_col_image['url']; ?>" alt="<?php echo $three_col_image['alt']; ?>">
										<?php if( !empty($three_col_button['url']) ){ ?>
											</a>
										<?php } ?>
									</div>
									<div class="card-content-wrap">
										<div>
											<?php if( !empty($three_col_title) ){ ?>

												<h6><?= $three_col_title; ?></h6>
											<?php }

											if( !empty($three_col_subtitle) ){ ?>

												<div class="editor-design">
													<p><?= $three_col_subtitle; ?></p>
												</div>
										</div>
											<?php }

										if( !empty($three_col_button['url']) && !empty($three_col_button['title']) ){ ?>

											<a href="<?= $three_col_button['url']; ?>" class="btn navyblue-btn mt-3"><?= $three_col_button['title']; ?></a>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php }
					} ?>
				</div>
			</div>
		</div>
	</section>
<?php } ?>