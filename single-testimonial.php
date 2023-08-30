<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
get_template_part('global-templates/inner-banner');

$reviewer_image = get_field('reviewer_image');
$reviewer_name = get_field('reviewer_name');
$reviewer_designation = get_field('reviewer_designation'); ?>

<section class="testimonial-list-section single-testimonial-section comman-padding" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/single-testimonial.jpg);">
    <div class="container">
        <div class="row">
            <div class="client-word">
                <div class="editor-design">
                    <?php the_content(); ?>
                </div>

                <?php if( !empty($reviewer_image) ){ ?>
                    
                    <div class="client-avtar-wrap">
                        <div class="client-avtar-inner-wrap">
                            <img src="<?php echo $reviewer_image; ?>" class="img-fluid" alt="">
                        </div>
                    </div>
                <?php }

                if( !empty($reviewer_name) ){ ?>
                
                    <h6><?= $reviewer_name; ?></h6>
                <?php }

                if( !empty($reviewer_designation) ){ ?>
                    
                    <p><?= $reviewer_designation; ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<?php
get_footer(); ?>