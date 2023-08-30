<?php
$general_settings = get_sub_field('general_settings'); 
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){
  
  $general_class .= 'comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){
  
  $general_class .= 'comman-margin';
}

$background_imagecolor = get_sub_field('background_imagecolor');
$background_image = get_sub_field('background_image');
$background_color = get_sub_field('background_color');
$background_image_url = isset($background_image['url']) ? $background_image['url'] : '';
$button_with_color = get_sub_field('button_with_color');
$button_with_outline = get_sub_field('button_with_outline');
if( $background_imagecolor == 'Image' && !empty($background_image_url) ){
$background_html = 'style="background-image: url('. $background_image_url .');"';
}else if( $background_imagecolor == 'Color' ){
$background_html = 'style="background-color: '. $background_color .';"';
} ?>
<!-- call-to-action-section-start -->
<section class="call-to-action-section overlay bg-color comman-padding <?= $general_class; ?>" <?= $background_html; ?>>
    <div class="full-width-wysiwyg text-center">
        <div class="container">
            <div class="editor-design">
                <?php if(get_sub_field('call_to_action_title')) { ?>
                <h1><?php echo get_sub_field('call_to_action_title'); ?></h1>
                <?php } ?>
                <?php if(get_sub_field('call_to_action_description')) { ?>
                <p><?php echo get_sub_field('call_to_action_description'); ?></p>
                <?php } ?>
            </div>
        </div>
    </div>     
    <div class="row text-center comman-callto-action">
        <div class="container">
            <div class="d-md-flex justify-content-center px-md-5 mt-4 btn-wrap">
                <?php if($button_with_color['title']) { ?>
                <a href="<?php echo $button_with_color['url']; ?>" target="<?php echo $button_with_color['target']; ?>" class="btn navyblue-btn mt-2 mx-3"><?php echo $button_with_color['title']; ?><img src="<?php  echo get_stylesheet_directory_uri(); ?>/images/arrow-right.svg" alt=""></a>
                <?php } ?>
                <?php if($button_with_outline['title']) { ?>
                <a href="<?php echo $button_with_outline['url']; ?>" target="<?php echo $button_with_outline['target']; ?>" class="btn btn-outline-navyblue mt-2 mx-3"><?php echo $button_with_outline['title']; ?><img src="<?php  echo get_stylesheet_directory_uri(); ?>/images/arrow-right.svg" alt=""></a>
                <?php } ?>
            </div>
        </div>
    </div>      
</section>
<!-- call-to-action-section-end -->   