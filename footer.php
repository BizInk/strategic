<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('understrap_container_type');

get_template_part('sidebar-templates/sidebar', 'footerfull');

$background_image = get_field('background_image', 'options');

if(!is_page( 'contact-us' )){

	$global_contact_bg = get_field('global_contact_bg', 'options');
	$global_contact_title = get_field('global_contact_title', 'options');
	$global_contact_description = get_field('global_contact_description', 'options');
	$global_contact_postal = get_field('global_contact_postal', 'options');
	$global_contact_address = get_field('global_contact_address', 'options');
	$global_contact_phone = get_field('global_contact_phone', 'options');
	$global_contact_email = get_field('global_contact_email', 'options');
	$global_contact_form = get_field('global_contact_form', 'options');
	 ?>

	<section class="get-in-touch comman-padding" style="background-image:url(<?php echo $global_contact_bg; ?>);">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-6 col-xxl-5">
	                <div class="location-wrap">
	                	
	                	<?php if( !empty($global_contact_title) ){ ?>

	                    	<h2><?= $global_contact_title; ?></h2>
	                    <?php } ?>

	                    <div class="editor-design">
	                		
	                		<?php if( !empty($global_contact_description) ){ ?>
	                        	
	                        	<p><?= do_shortcode($global_contact_description); ?></p>
	                    	<?php } ?>
	                    </div>

                		<?php if( !empty($global_contact_postal) ){ ?>

	                    	<strong>Postal address: <?= $global_contact_postal; ?></strong>
                    	<?php } ?>
	                    <ul>
                			<?php if( !empty($global_contact_address) ){ ?>
	                        	
	                        	<li><i class="fa fa-map-marker" aria-hidden="true"></i><a href="https://maps.google.com?q=<?= str_replace('[br]', '', $global_contact_address); ?>" target="_blank"><?= do_shortcode($global_contact_address); ?></a></li>                        
                    		<?php }

                    		if( !empty($global_contact_phone) ){ ?>
	                        	
	                        	<li><i class="fa fa-mobile" aria-hidden="true"></i><a href="tel:<?= str_replace(array(' ', '(', ')'), array('', '', ''), $global_contact_phone); ?>"><?= $global_contact_phone; ?></a></li> 
	                        <?php }

                    		if( !empty($global_contact_email) ){ ?>

	                        	<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?= $global_contact_email; ?>"><?= $global_contact_email; ?></a></li>
	                        <?php } ?>
	                    </ul>
	                    <ul class="social-nav">
							<li><a href="https://www.facebook.com/StrategicWealth?mibextid=ZbWKwL" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="https://www.linkedin.com/in/nicholas-moustacas-bb78881?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3BzdHFCv4cTbaUytB32UwwKw%3D%3D" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>							
						</ul>
	                </div>
	            </div> 

	            <div class="col-md-6 col-xxl-7">
	                <div class="form-wrp">                    
                		<?php if( !empty($global_contact_form['id']) ){
	                    	
	                    	echo do_shortcode('[gravityform id="'. $global_contact_form['id'] .'" title="false"]');
	                    } ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
<?php }

$footer_logo = get_field('footer_logo', 'options');
$footer_text = get_field('footer_text', 'options');

$column_1_title = get_field('column_1_title', 'options');
$column_2_title = get_field('column_2_title', 'options');
$column_3_title = get_field('column_3_title', 'options');
$newsletter_text = get_field('newsletter_text', 'options');
$newsletter_form = get_field('newsletter_form', 'options');

echo get_field('custom_embed_code_after_body','options');
?>

 <footer>
	<div class="container">
		<div class="row footer-wrap">
			<div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
				<div class="footer-logo">
					<?php if( !empty($footer_logo['url']) ){ ?>

						<a href="<?= site_url(); ?>"><img src="<?php echo $footer_logo['url']; ?>" alt="<?php echo $footer_logo['alt']; ?>"></a>
					<?php }

					if( !empty($footer_text) ){ ?>

						<div class="footer-content">
							<?= $footer_text; ?>
						</div>
					<?php } ?>
					<ul class="social-nav">
						<li><a href="https://www.facebook.com/StrategicWealth?mibextid=ZbWKwL" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="https://www.linkedin.com/in/nicholas-moustacas-bb78881?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3BzdHFCv4cTbaUytB32UwwKw%3D%3D" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						
					</ul>
				</div>
			</div>
			<div class="col-md-6 col-lg-2 mb-5 mb-lg-0">
				<?php if( !empty($column_1_title) ){ ?>

					<h6><?= $column_1_title; ?></h6>
				<?php 
				}

				wp_nav_menu( array(
					'container' => 'nav',
					'fallback_cb' => false,
					'theme_location' => 'footer-menu1',
				) ); ?>
			</div>
			<div class="col-md-6 col-lg-2 mb-5 mb-lg-0">
				<?php if( !empty($column_2_title) ){ ?>

					<h6><?= $column_2_title; ?></h6>
				<?php 
				}

				wp_nav_menu( array(
					'container' => 'nav',
					'fallback_cb' => false,
					'theme_location' => 'footer-menu2',
				) ); ?>
			</div>
			<div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
				<div class="newsletter-wrap">				
					<?php if( !empty($column_3_title) ){ ?>

						<h6><?= $column_3_title; ?></h6>
					<?php }

					if( !empty($newsletter_text) ){ ?>

						<p><?= $newsletter_text; ?></p>
					<?php }

					if( !empty($newsletter_form['id']) ){

						echo do_shortcode('[gravityform id="'. $newsletter_form['id'] .'" title="false"]');
					} ?>
				</div>
			</div>
		</div>
	</div>

	<?php $copyright = get_field('copyright', 'options');

	if( !empty($copyright) ){ ?>

		<div class="container social-wrap">
			<div class="row">				
				<div class="col-md-12">
					<div class="copyright-wrap">
						<?= $copyright; ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>

</footer> 
<!-- testimonial-section-end --> 

</div><!-- #page we need this extra closing tag here -->

<?php
echo get_field('custom_embed_code_-_footer','options');
wp_footer();
?> 
<script>

	var bizinklucaAjax = {"ajaxurl":"https:\/\/bizinkluca.betatesting87.com\/wp-admin\/admin-ajax.php"};

	function fetch_blog_posts(category='', pagenumber=1){ 
		// Check if we are on correct page
		if( jQuery('.blog-posts-cont').length ){

			if( pagenumber == 1 ){

				jQuery('.blog-posts-cont').html('Loading...');
			}else{
				jQuery('.load-more').text('Loading...');
			}
           
			jQuery.ajax({
				type : "post",
				url  :  "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				data : {action: "fetch_blog_posts", category: category, pagenumber: pagenumber},
				success: function(response) {
					var result = JSON.parse(response);

					if( pagenumber == 1 ){
						
						jQuery('.blog-posts-cont').html(result.content);
					}else{
						jQuery('.load-more').remove();
						jQuery('.blog-posts-cont .row').append(result.content);
					}
					jQuery('.blog-posts-cont').append(result.load_more);
				}
			}); 
		}
	}

	function fetch_resources(topic='',type='', pagenumber=1){ 
		// Check if we are on correct page
		if( jQuery('.resources-cont').length ){

			if( pagenumber == 1 ){

				jQuery('.resources-cont').html('Loading...');
			}else{
				jQuery('.load-more').text('Loading...');
			}
           
			jQuery.ajax({
				type : "post",
				url  :  "<?php echo admin_url( 'admin-ajax.php' ); ?>",
				data : {action: "fetch_resources", topic: topic, type: type, pagenumber: pagenumber},
				success: function(response) {
					var result = JSON.parse(response);

					console.log(result)

					if( pagenumber == 1 ){
						
						jQuery('.resources-cont').html(result.content);
					}else{
						jQuery('.resources-load-more').remove();
						jQuery('.resources-cont .row').append(result.content);
					}

					if( result.load_more != 'nomore' ){

						jQuery('.resources-cont').append(result.load_more);
					}
				}
			}); 
		}
	}	 

	jQuery(document).on('click', '.filter-wrap li', function(e){
		e.preventDefault();

		jQuery('.filter-wrap li.active').removeClass('active');
		jQuery(this).addClass('active');

		fetch_blog_posts(jQuery(this).attr('data-cat'));

	});

	jQuery(document).on('click', '.load-more', function(e){
		e.preventDefault();

		fetch_blog_posts(jQuery('.filter-wrap li.active').attr('data-cat'), jQuery(this).attr('data-pagenumber'));
	});

	// Resources code
	jQuery(document).on('click', '.resources-filter li', function(e){
		e.preventDefault();

		jQuery(this).parents('.resources-filter').find('li.active').removeClass('active');
		jQuery(this).addClass('active');

		fetch_resources(jQuery('.resources-filter-topic li.active').attr('data-cat'),jQuery('.resources-filter-type li.active').attr('data-cat'));

	});

	jQuery(document).on('click', '.resources-load-more', function(e){
		e.preventDefault();

		fetch_resources(jQuery('.resources-filter-topic li.active').attr('data-cat'),jQuery('.resources-filter-type li.active').attr('data-cat'), jQuery(this).attr('data-pagenumber'));
	});
</script>

<!-- If blog page -->
<?php if( is_home() ){ ?>
	
	<script>
		fetch_blog_posts();
	</script>
<?php } ?>

<!-- If archive page -->
<?php if( is_archive() ){ ?>
	
	<script>
		fetch_blog_posts('<?= get_queried_object()->term_id; ?>');
	</script>
<?php } ?>

<!-- If resources page -->
<?php if( is_page('resources') ){ ?>
	
	<script>
		fetch_resources();
	</script>
<?php } ?>

</body>
</html>