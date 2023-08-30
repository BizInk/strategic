<?php
$general_settings = get_sub_field('general_settings');
$alignment = get_sub_field_object('alignment');
$full_width_section_bg = get_sub_field('full_width_section_bg');
$small_title = get_sub_field('full_width_section_small_title');
$large_title = get_sub_field('full_width_section_title');
$contents = get_sub_field('full_width_section_content');
$map_iframe = get_sub_field('add_iframe');

$general_class = '';
$align_class = '';

if( in_array('Add Common Padding', $general_settings) ){

	$general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){

	$general_class .= ' comman-margin';
}

if( $alignment['value'] == "Align left" ){
	$align_class .= 'text-left';
}

if( $alignment['value'] == "Align right"  ){
	$align_class .= 'text-right';
}

if( $alignment['value'] == "Align center" ){
	$align_class .= 'text-center';
}

?>

<section class="full-width-section comman-padding" style="background-image:url(<?= $full_width_section_bg; ?>);">
	<div class="full-width-wysiwyg">
		<div class="container">
			<div class="editor-design <?php echo $align_class ?> ">
				<?php if( !empty($small_title) ){ ?>
					<h6><?php echo $small_title; ?></h6>
				<?php } ?>

				<?php
				if( !empty($large_title) ){ ?>
					<h2><?php echo $large_title; ?></h2>
				<?php } ?>

				<?php

				if( !empty($contents) ){ ?>
					<p><?php echo $contents; ?></p>
				<?php } 
				?>
			</div>
		</div>
		<div class="infobox-warp iframe-section">
			<div class="container">
				<?php
					if( !empty($map_iframe) ){ 
					 echo $map_iframe;
					} 
				?>
			</div>
		</div>
	</div>
</section>