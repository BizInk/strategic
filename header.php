<?php

/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$bootstrap_version = get_theme_mod('understrap_bootstrap_version', 'bootstrap5');
$navbar_type       = get_theme_mod('understrap_navbar_type', 'collapse');

$favicon = get_field('favicon', 'options');
$company_phone = get_field('company_phone', 'options');

$facebook = get_field('facebook', 'options');
$twitter = get_field('twitter', 'options');
$linkedin = get_field('linkedin', 'options');
$instagram = get_field('instagram', 'options');
$youtube = get_field('youtube', 'options');
$google_my_business = get_field('google_my_business', 'options'); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php 
	wp_head();
	echo get_field('custom_embed_code_head','options');
	$css = get_field('header_custom_css','options');
	if( !empty($css) ): ?>
		<style type="text/css">
			<?= $css; ?>
		</style>
	<?php endif; ?>
	
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
	<?php do_action('wp_body_open'); ?>
	<div class="site" id="page">

		<!-- ******************* The Navbar Area ******************* -->
		<header id="wrapper-navbar" class=""> 

				<div class="top-nav">
					<div class="container">
						<?php if( !empty($company_phone) ){ ?>

							<div class="header-contact">
								<ul>															
									<li><a href="tel:<?= $company_phone; ?>" target="_blank"><i class="fa fa-phone" aria-hidden="true"></i><?= $company_phone; ?></a></li>	
								</ul>										
							</div>
						<?php } ?>
						
						<div>						
							<div class="client-area-wrap">
								<div class="client-area-anchor">Client Area <i class="fa fa-angle-down" aria-hidden="true"></i></div>
								<div class="client-area-cont">
									<div class="menu-client-area-container">
									<?php 
									wp_nav_menu( array(
										'menu_class' => 'menu',
										'container' => false,
										'fallback_cb' => false,
										'theme_location' => 'client-area', 
									) ); ?> 
									</div>
								</div>
							</div>
							<ul class="social-nav">
								<?php if( !empty($facebook) ){ ?>
	                            	
	                            	<li><a href="<?= $facebook; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<?php }
								
								if( !empty($twitter) ){ ?>
	                            	
	                            	<li><a href="<?= $twitter; ?>" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<?php }
								
								if( !empty($linkedin) ){ ?>
	                            	
	                            	<li><a href="<?= $linkedin; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
								<?php }
								
								if( !empty($instagram) ){ ?>
	                            	
	                            	<li><a href="<?= $instagram; ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<?php }
								
								if( !empty($youtube) ){ ?>
	                            	
	                            	<li><a href="<?= $youtube; ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
								<?php }
								
								if( !empty($google_my_business) ){ ?>
	                            	
	                            	<li><a href="<?= $google_my_business; ?>" target="_blank"><i class="fa fa-google" aria-hidden="true"></i></a></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			<?php

			get_template_part('global-templates/navbar', $navbar_type . '-' . $bootstrap_version); ?>

		</header>