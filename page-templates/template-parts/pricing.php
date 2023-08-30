<?php
$general_settings = get_sub_field('general_settings'); 
$general_class = '';

if( in_array('Add Common Padding', $general_settings) ){
  
  $general_class .= ' comman-padding';
}

if( in_array('Add Common Margin', $general_settings) ){
  
  $general_class .= ' comman-margin';
}

$pricing_sub_title = get_sub_field('pricing_sub_title');
$pricing_title = get_sub_field('pricing_title');
$pricing_description = get_sub_field('pricing_description');
$columns_number = get_sub_field('columns_number');
$columns_classes = 'col-md-6 col-lg-4';
if( $columns_number == 4 ){
$columns_classes = 'col-md-6 col-lg-3';
}

$choose_pricing_packeges = get_sub_field("choose_pricing_packeges");

?>


<section class="pricing-section<?= $general_class; ?>" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/pricing-packege-img.jpg);">
    <div class="full-width-wysiwyg text-center">
        <div class="container">
            <div class="editor-design">
                <?php if($pricing_sub_title) { ?>
                <h5><?php echo $pricing_sub_title; ?></h5>
                <?php }
                if($pricing_title) { ?>
                <h2><?php echo $pricing_title; ?></h2>
                <?php }
                if($pricing_description) { ?>
                <p><?php echo $pricing_description; ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row gy-5 g-md-5 <?= $columns_number == 5 ? 'row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5' : null; ?>">

           
            <?php
                    if($choose_pricing_packeges):

                        foreach( $choose_pricing_packeges as $post ): 
                        // Setup this post for WP functions (variable must be named $post).
                        setup_postdata($post); ?>

                        <div class="<?= $columns_classes; ?>">
                            <div class="card box-shadow">
                                <div class="card-header text-center">
                                    <h6><?php echo get_the_title(); ?></h6>
                                    <p><?php echo get_field("price_description"); ?></p>
                                    <?php $price = get_field('price');
                                    $show_price_per_period = get_field( 'show_price_per_period' );
                                    ?>
                                    <?php if($price) { ?>
                                        <div class="price-wrap"> 
                                            <p>Take it for only:</p>
                                            <h2 class="card-title pricing-card-title">$<?php echo $price; ?><sup>,00</sup><small>/ <?php echo $show_price_per_period; ?></small></h2>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php if( have_rows('price_features') ): ?>
                                <div class="card-body pt-0">
                                    <ul>
                                        <?php while( have_rows('price_features') ): the_row();
                                        $features = get_sub_field('features');
                                        if($features) { ?>
                                        <li> <span><?php echo $features; ?></span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/check-icon.svg" alt=""></li>
                                        <?php }
                                        endwhile; ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <div class="card-footer">
                                    <?php
                                    $price_button_label = get_field('price_button_label');
                                    $price_button_url = get_field('price_button_url');
                                    
                                    if( $price_button_label ) { ?>
                                    <a href="<?php echo $price_button_url; ?>" class="btn navyblue-btn mt-4 w-100"><?php echo $price_button_label; ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    <?php  endforeach;  ?>
                <?php
                // Reset the global post object so that the rest of the page works correctly.
                wp_reset_postdata();
                endif;
            ?>

            
        </div>
    </div>
</section>