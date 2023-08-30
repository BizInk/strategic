<?php

$our_team_title = get_field('our_team_title');
$our_team_content = get_field('our_team_content');
$our_team_members = get_sub_field("our_team_people"); ?>

<section class="team-section comman-padding" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/bg-shape-xl.jpg);">
    <div class="full-width-wysiwyg text-center m-0">
        <div class="container">
            <div class="editor-design">
                <?php if( !empty($our_team_title) ){ ?>
                <h2><?= do_shortcode($our_team_title); ?></h2>
                <?php }
                echo $our_team_content; ?>
            </div>
        </div>
    </div>

    <?php if( !empty($our_team_members) ){ ?>
    <div class="container">
        <div class="team-wrap">
            <div class="row g-lg-5 justify-content-center">
                <?php foreach( $our_team_members as $post ){
                // Setup this post for WP functions (variable must be named $post).
                setup_postdata($post); 
                $member_image = get_field('member_image');
                $member_position = get_field('member_position'); 
                $member_bio = get_field("member_bio");
                $member_facts = get_field("member_facts");
                $member_facebook = get_field("member_facebook");
                $member_twitter = get_field("member_twitter");
                $member_instagram = get_field("member_instagram");
                $member_linkedin = get_field("member_linkedin");

                ?>

                <div class="col-md-6 col-lg-4 team-member">
                    <div class="team-member-wrap">
                        <?php if( !empty($member_image) ){ ?>
                        <div class="member-img">
                            <img src="<?= $member_image; ?>" alt="member-img">
                        </div>
                        <?php } ?>
                        <div class="member-details">
                            <h3><?= get_the_title(); ?></h3>
                            
                            <?php if( !empty($member_position) ){ ?>
                            <h6><?= $member_position; ?></h6>
                            <?php } ?>
                            <ul class="social-nav">

                                <?php 
                                	if(!empty( $member_facebook )){
                                		echo '<li><a href="'. $member_facebook .'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
                                	}
                                	if(!empty( $member_twitter )){
                                		echo '<li><a href="'. $member_twitter .'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
                                	}
                                	if(!empty( $member_instagram )){
                                		echo '<li><a href="'. $member_instagram .'" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>';
                                	}
                                	if(!empty( $member_linkedin )){
                                		echo '<li><a href="'. $member_linkedin.'" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>';
                                	}
                            	?>
                                
                            </ul>
                        </div>
                        <div class="member-full-details d-flex flex-column justify-content-between">
                            <div>
                            	<?php
                            		if(!empty($member_bio)){
                            			echo $member_bio;
                            		}
                            	?>
                                
                            </div>
                            <div>
                            	<?php 
                            		if(!empty($member_facts)){
                            			echo $member_facts;
                            		}
                            	?>
                            </div>                            
                        </div>
                    </div>
                </div>
                <?php }

                wp_reset_postdata(); ?>
                
            </div>
        </div>
    </div>
    <?php } ?>

</section>



