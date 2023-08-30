
<?php
$general_settings = get_sub_field('general_settings'); 
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){
  
  $general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){
  
  $general_class .= ' comman-margin';
}

$logo_title = get_sub_field('logo_title');
$logo_description = get_sub_field('logo_description');

if( have_rows('logo') ): ?>

    <section class="logo-section bg-option text-center<?= $general_class; ?>">
        <div class="full-width-wysiwyg text-center">
            <div class="container">
                <div class="editor-design">
                    <?= !empty($logo_title) ? '<h2>'. $logo_title .'</h2>' : null; ?>
                    <?= !empty($logo_description) ? $logo_description : null; ?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="logo-slider">
                <?php if( have_rows('logo') ):

                    while( have_rows('logo') ):
                    the_row();

                        $slider_image = get_sub_field('slider_image');
                        $slider_link = get_sub_field('slider_link');

                        if( !empty($slider_image) ){ ?>

                            <div class="logo">

                                <?php if( !empty($slider_link) ){ ?>
                                    
                                    <a href="<?= $slider_link; ?>" target="_blank">
                                <?php } ?>

                                    <img src="<?php echo $slider_image; ?>" class="img-fluid" alt="">

                                <?php if( !empty($slider_link) ){ ?>
                                    </a> 
                                <?php } ?>
                            </div>
                        <?php }
                    endwhile;
                endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
