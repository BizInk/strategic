<?php
$contact_background = get_sub_field("contact_background");
$contact_heading = get_sub_field("contact_heading");
$contact_description = get_sub_field("contact_description");
$contact_postal_address = get_sub_field("contact_postal_address");
$contact_location = get_sub_field("contact_location");
$location_url = get_sub_field("location_url");
$contact_phone = get_sub_field("contact_phone");
$contact_email = get_sub_field("contact_email");
$contact_add_form = get_sub_field("contact_add_form");

$facebook = get_field('facebook', 'options');
$linkedin = get_field('linkedin', 'options'); ?>

<section class="get-in-touch contact-info-flexible comman-padding" style="background-image:url(<?php echo $contact_background; ?>);">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="location-wrap">
                    <?php 
                        if(!empty($contact_heading)){
                            echo "<h2>". $contact_heading  ."</h2>";
                        }
                    ?>
                   
                    <div class="editor-design">
                        <?php 
                            if(!empty($contact_description)){
                                echo do_shortcode($contact_description);
                            }

                        ?>
                    </div>
                    <?php 
                        if(!empty($contact_postal_address)){
                            echo "<strong>Postal address: ". $contact_postal_address ."</strong>";
                        }
                    ?>
                    <ul>
                        <?php 
                            if(!empty($contact_location)){
                                ?>
                                  <li><i class="fa fa-map-marker" aria-hidden="true"></i><a href="https://maps.google.com?q=<?php echo str_replace(array('[br]'), array(''), $contact_location); ?>" target="_blank"><?php echo do_shortcode($contact_location); ?></a></li>
                                <?php
                            }
                        ?>

                        <?php
                            if(!empty($contact_phone)){
                                ?>
                                  <li><i class="fa fa-mobile" aria-hidden="true"></i><a href="tel:<?php echo $contact_phone; ?>"><?php echo $contact_phone; ?></a></li>
                                <?php
                            }
                        ?>
                        
                        <?php
                            if(!empty($contact_email)){
                                ?>
                                  <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a></li>
                                <?php
                            }
                        ?>
                       
                        
                    </ul>

                    <?php if( !empty($facebook) || !empty($linkedin) ){ ?>

                        <ul class="social-nav">
                            <?php if( !empty($facebook) ){ ?>

                                <li><a href="<?= $facebook; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <?php }

                            if( !empty($linkedin) ){ ?>

                                <li><a href="<?= $linkedin; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <?php } ?>                  
                        </ul>
                    <?php } ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-wrp">  
                    <?php if( !empty($contact_add_form['id']) ){
                                
                        echo do_shortcode('[gravityform id="'. $contact_add_form['id'] .'" title="false"]');
                    } ?>
                </div>
            </div>            
        </div>
    </div>
</section>