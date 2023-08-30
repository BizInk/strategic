<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

define('DEFAULT_IMG', get_stylesheet_directory_uri().'/images/default.jpg');


/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @param string $current_mod The current value of the theme_mod.
 * @return string
 */
function understrap_default_bootstrap_version( $current_mod ) {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );

/* add_filter( 'nav_menu_link_attributes', 'luca_menu_add_class', 10, 3 );
function luca_menu_add_class( $atts, $item, $args ) {
    $class = 'nav-link';
    $atts['class'] = $class;
    return $atts;
} */

/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );


// This theme uses wp_nav_menu() in two locations.  
register_nav_menus( array(  
  'footer-menu1' => __( 'Footer Menu1', 'understrap-child' ),  
  'footer-menu2' => __( 'Footer Menu2', 'understrap-child' ),
  'client-area' => __( 'Client Area', 'understrap-child' )
) );

/**
 * Add a new dashboard widget.
 */
function wpdocs_add_dashboard_widgets() {
	$feed_url = get_field('feed_title', 'option');
    wp_add_dashboard_widget( 'dashboard_widget', $feed_url, 'dashboard_widget_function' );
}
add_action( 'wp_dashboard_setup', 'wpdocs_add_dashboard_widgets' );


  /*
*	Re-usable RSS feed reader with shortcode
*/
if ( !function_exists('base_rss_feed') ) {
	$feed_url = get_field('feed_url', 'option');
	function base_rss_feed($size = 5, $feed = '$feed_url', $date = false, $cache_time = 1800)
	{
		// Include SimplePie RSS parsing engine
		include_once ABSPATH . WPINC . '/feed.php';
 
		// Set the cache time for SimplePie
		add_filter( 'wp_feed_cache_transient_lifetime', create_function( '$a', "return $cache_time;" ) );
 
		// Build the SimplePie object
		$rss = fetch_feed($feed);

		// Check for errors in the RSS XML
		if ( !is_wp_error( $rss ) ) {
 
			// Set a limit for the number of items to parse
			$maxitems = $rss->get_item_quantity($size);
			$rss_items = $rss->get_items(0, $maxitems);
 
			// Store the total number of items found in the feed
			$i = 0;
			$total_entries = count($rss_items);
            
			// Output HTML
			$html = "<ul class='rss-widget'>";
            // echo '<ul class="rss-widget">';
			foreach ($rss_items as $item) {
				 
				$i++;
 
				// Add a class of "last" to the last item in the list
				if( $total_entries == $i ) {
					$last = " class='last'";
				} else {
					$last = "";
				}
 
				// Store the data we need from the feed
				$title = $item->get_title();
				$link = $item->get_permalink();
				$desc = $item->get_description();
				$date_posted = $item->get_date('F j, Y');
 
				// Output
				$html .= "";
				$html .= '<li class="rss-widget-title"><a href="'.$link.'"><b>'."$title".'</b></a><span clas="rss-date">&nbsp;'.$date_posted.'</span></li>';
				// if( $date == true ) $html .= "$date_posted";
				// $html .= '<li class="rss-widget-description">'."$desc".'</li>';
				$html .= '<li class="rss-widget-description">'.wp_trim_words( $desc, 50, '&nbsp[...]' ).'</li>';
				$html .= "";
			 
			}
			// echo '</ul>';
           
            $html .= "</ul>";

             

		} else {
 
			$html = "An error occurred while parsing your RSS feed. Check that it's a valid XML file.";
 
		}
 

		return $html;

	}
}

/** Define [rss] shortcode */
if( function_exists('base_rss_feed') && !function_exists('base_rss_shortcode') ) {

	$feed_url = get_field('feed_url', 'option');

	function base_rss_shortcode($atts) {
		extract(shortcode_atts(array(
			'size' => '3',
			'feed' => $feed_url,
			'date' => false,
		), $atts));
		
		$content = base_rss_feed($size, $feed, $date);
		return $content;
	}
	add_shortcode("rss", "base_rss_shortcode");
}

/**
 * Output the contents of the dashboard widget
 */
function dashboard_widget_function( $post, $callback_args ) {
    // esc_html_e( "Hello World, this is my first Dashboard Widget!", "textdomain" );
    $feed_url = get_field('feed_url', 'option');
   if( function_exists('base_rss_feed') ) echo base_rss_feed(3, $feed_url, true);

}

add_filter( 'gform_enable_password_field', '__return_true' );
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $path;
    
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $paths;
    
}

add_action( 'init', 'wpdocs_custom_init' );
function wpdocs_custom_init() {
	remove_post_type_support('post','excerpt');
	remove_post_type_support('fixed-price-packages','excerpt');
	remove_post_type_support('testimonial','excerpt');
	remove_post_type_support('team-member','excerpt');
	remove_post_type_support('mail-template','excerpt');
	remove_post_type_support('checklist','excerpt');

	// Remove editor from only flexible page template
	if ( isset($_GET['post']) ) {

        $page_id = $_GET['post'];
		$template = get_post_meta($page_id, '_wp_page_template', true);
		
		if( $template == 'page-templates/flexible-content.php' ){	

	        remove_post_type_support('page', 'editor');
		}
	}

	// Fixed Price Packages CPT
	$fixed_price_packages_labels = array(
		'name'                  => _x( 'Fixed Price Packages', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Fixed Price Package', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Fixed Price Packages', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Fixed Price Package', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Fixed Price Package', 'luca' ),
		'new_item'              => __( 'New Fixed Price Package', 'luca' ),
		'edit_item'             => __( 'Edit Fixed Price Package', 'luca' ),
		'view_item'             => __( 'View Fixed Price Package', 'luca' ),
		'all_items'             => __( 'All Fixed Price Packages', 'luca' ),
		'search_items'          => __( 'Search Fixed Price Packages', 'luca' ),
		'parent_item_colon'     => __( 'Parent Fixed Price Packages:', 'luca' ),
		'not_found'             => __( 'No fixed price packages found.', 'luca' ),
		'not_found_in_trash'    => __( 'No fixed price packages found in Trash.', 'luca' ),
	);

	$fixed_price_packages_args = array(
		'labels'             => $fixed_price_packages_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-analytics',
		'rewrite'            => array( 'slug' => 'fixed-price-packages' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'author', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'fixed-price-packages', $fixed_price_packages_args );

	// Testimonials CPT
	$testimonials_labels = array(
		'name'                  => _x( 'Testimonials', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Testimonials', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Testimonials', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Testimonial', 'luca' ),
		'new_item'              => __( 'New Testimonial', 'luca' ),
		'edit_item'             => __( 'Edit Testimonial', 'luca' ),
		'view_item'             => __( 'View Testimonial', 'luca' ),
		'all_items'             => __( 'All Testimonials', 'luca' ),
		'search_items'          => __( 'Search Testimonials', 'luca' ),
		'parent_item_colon'     => __( 'Parent Testimonial:', 'luca' ),
		'not_found'             => __( 'No testimonials found.', 'luca' ),
		'not_found_in_trash'    => __( 'No testimonials found in Trash.', 'luca' ),
	);

	$testimonials_args = array(
		'labels'             => $testimonials_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-testimonial',
		'rewrite'            => array( 'slug' => 'testimonial' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'testimonial', $testimonials_args );

	// Team Members CPT
	$team_members_labels = array(
		'name'                  => _x( 'Team Members', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Team Member', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Team Members', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Team Members', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Team Member', 'luca' ),
		'new_item'              => __( 'New Team Member', 'luca' ),
		'edit_item'             => __( 'Edit Team Member', 'luca' ),
		'view_item'             => __( 'View Team Member', 'luca' ),
		'all_items'             => __( 'All Team Members', 'luca' ),
		'search_items'          => __( 'Search Team Members', 'luca' ),
		'parent_item_colon'     => __( 'Parent Team Member:', 'luca' ),
		'not_found'             => __( 'No team Members found.', 'luca' ),
		'not_found_in_trash'    => __( 'No team Members found in Trash.', 'luca' ),
	);

	$team_members_args = array(
		'labels'             => $team_members_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-groups',
		'rewrite'            => array( 'slug' => 'team-member' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'team-member', $team_members_args );

	// Mail Templates CPT
	$mail_templates_labels = array(
		'name'                  => _x( 'Mail Templates', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Mail Template', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Mail Templates', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Mail Templates', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Mail Template', 'luca' ),
		'new_item'              => __( 'New Mail Template', 'luca' ),
		'edit_item'             => __( 'Edit Mail Template', 'luca' ),
		'view_item'             => __( 'View Mail Template', 'luca' ),
		'all_items'             => __( 'All Mail Templates', 'luca' ),
		'search_items'          => __( 'Search Mail Templates', 'luca' ),
		'parent_item_colon'     => __( 'Parent Mail Template:', 'luca' ),
		'not_found'             => __( 'No mail templates found.', 'luca' ),
		'not_found_in_trash'    => __( 'No mail templates found in Trash.', 'luca' ),
	);

	$mail_templates_args = array(
		'labels'             => $mail_templates_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-book-alt',
		'rewrite'            => array( 'slug' => 'mail-template' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'mail-template', $mail_templates_args );

	// Checklists CPT
	$checklist_labels = array(
		'name'                  => _x( 'Checklists', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Checklist', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Checklists', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Checklists', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Checklist', 'luca' ),
		'new_item'              => __( 'New Checklist', 'luca' ),
		'edit_item'             => __( 'Edit Checklist', 'luca' ),
		'view_item'             => __( 'View Checklist', 'luca' ),
		'all_items'             => __( 'All Checklists', 'luca' ),
		'search_items'          => __( 'Search Checklists', 'luca' ),
		'parent_item_colon'     => __( 'Parent Checklist:', 'luca' ),
		'not_found'             => __( 'No checklists found.', 'luca' ),
		'not_found_in_trash'    => __( 'No checklists found in Trash.', 'luca' ),
	);

	$checklist_args = array(
		'labels'             => $checklist_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-yes',
		'rewrite'            => array( 'slug' => 'checklist' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'checklist', $checklist_args );

	// Landing Pages CPT
	$landing_page_labels = array(
		'name'                  => _x( 'Landing Pages', 'Post type general name', 'luca' ),
		'singular_name'         => _x( 'Landing Page', 'Post type singular name', 'luca' ),
		'menu_name'             => _x( 'Landing Pages', 'Admin Menu text', 'luca' ),
		'name_admin_bar'        => _x( 'Landing Pages', 'Add New on Toolbar', 'luca' ),
		'add_new'               => __( 'Add New', 'luca' ),
		'add_new_item'          => __( 'Add New Landing Page', 'luca' ),
		'new_item'              => __( 'New Landing Page', 'luca' ),
		'edit_item'             => __( 'Edit Landing Page', 'luca' ),
		'view_item'             => __( 'View Landing Page', 'luca' ),
		'all_items'             => __( 'All Landing Pages', 'luca' ),
		'search_items'          => __( 'Search Landing Pages', 'luca' ),
		'parent_item_colon'     => __( 'Parent Landing Page:', 'luca' ),
		'not_found'             => __( 'No landing pages found.', 'luca' ),
		'not_found_in_trash'    => __( 'No landing pages found in Trash.', 'luca' ),
	);

	$landing_page_args = array(
		'labels'             => $landing_page_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'menu_icon' 		 => 'dashicons-desktop',
		'rewrite'            => array( 'slug' => 'landing-page' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);

	register_post_type( 'landing-page', $landing_page_args );
}

// Adding option to select gravity form in ACF
add_filter( 'acf/load_field/name=gravity_forms', 'luca_acf_populate_gf_forms_ids' );
function luca_acf_populate_gf_forms_ids( $field ) {
	if ( class_exists( 'GFFormsModel' ) ) {
		$choices = [];

		foreach ( \GFFormsModel::get_forms() as $form ) {
			$choices[ $form->id ] = $form->title;
		}

		$field['choices'] = $choices;
	}

	return $field;
}

// Function to show star rating
function bage_star_rating($rating){
	if( $rating > 0 && $rating <= 5 ){

	    $rating_round = (int)$rating;
	    $half = $rating - $rating_round;
	    $half = $half > 0 ? true : false;

	    while( $rating_round > 0 ){
	    	echo '<i class="fa fa-star" aria-hidden="true"></i>';

	    	$rating_round--;
	    }

	    echo $half ? '<i class="fa fa-star-half-o" aria-hidden="true"></i>' : null;
	}
}



// Ajax callback function to fetch and load more posts on blog page
add_action("wp_ajax_fetch_blog_posts", "fetch_blog_posts");
add_action("wp_ajax_nopriv_fetch_blog_posts", "fetch_blog_posts");

function fetch_blog_posts() {

	$category = $_POST['category'];
	$pagenumber = $_POST['pagenumber'];
	$ppp = 9;

	$posts_args = array(
	    'post_status' => 'publish', 
	    'order' => 'DESC',
	    'paged'	=> $pagenumber,
	    'posts_per_page' => $ppp, 
	);

	if( !empty($category) ){

		$posts_args['cat'] = $category;
	}

	$posts_loop = new WP_Query( $posts_args );

	$return_content = array('content' => '', 'load_more' => '');

	if( $posts_loop->have_posts() ){

		ob_start();

		if( $pagenumber == 1 ){ ?>

			<div class="row g-lg-5">
		<?php }
			while( $posts_loop->have_posts() ){
				$posts_loop->the_post();

				$post_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : DEFAULT_IMG; ?>

				<div class="col-md-6 col-xl-4 blog">
	                    <div class="blog-inner-wrap">
	                        <div class="blog-img">
	                            <a href="<?php the_permalink(); ?>"><img src="<?= $post_image; ?>" alt="member-img"></a>
	                        </div>
	                        <div class="blog-details">
	                            <div class="meta">
	                                <span class="author">Posted by <?php the_author(); ?></span> <span class="posted-on"><?php the_date('d M Y'); ?></span> 
	                            </div>
	                            <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
	                            <div class="description">
	                                <?php the_excerpt(); ?>
	                            </div> 
	                            <a href="<?php the_permalink(); ?>" class="readmore">Read More<img src="<?php  echo get_stylesheet_directory_uri(); ?>/images/arrow-right.svg" alt=""></a>                           
	                        </div>
	                    </div>
	                </div>
			<?php }
		if( $pagenumber == 1 ){ ?>
			
			</div>
		<?php }
		$return_content['content'] = ob_get_contents();
		ob_end_clean();

		if( $posts_loop->found_posts > ($ppp*$pagenumber) ){
			
			$return_content['load_more'] = '<a href="#" class="btn blue-btn load-more navyblue-btn" data-pagenumber="'. ($pagenumber+1) .'">Load More<img src="'. get_stylesheet_directory_uri() .'/images/arrow-right.png" class="img-fluid btn-arrow" alt=""></a>';
		}

	}else{
		$return_content['content'] = 'No posts found!';
	}

	wp_reset_query();

	echo json_encode($return_content);

die();
}

// Ajax callback function to fetch and load more posts on blog page
add_action("wp_ajax_fetch_resources", "fetch_resources");
add_action("wp_ajax_nopriv_fetch_resources", "fetch_resources");

function fetch_resources() {

	$topic = (int)$_POST['topic'];
	$type = (int)$_POST['type'];
	$pagenumber = $_POST['pagenumber'];
	$ppp = 9;

	$resources_args = array(
	    'post_type' => 'resource', 
	    'post_status' => 'publish', 
	    'orderby' => 'publish_date',
	    'order' => 'DESC',
	    'paged'	=> $pagenumber,
	    'posts_per_page' => $ppp, 
	);

	if( !empty($topic) || !empty($type) ){

		$resources_args['tax_query'] = array(
			'relation' => 'OR');
	}

	if( !empty($topic) ){

		$resources_args['tax_query'][] = array(
            'taxonomy' => 'content-topic',
            'field'    => 'term_id',
            'terms'    => array($topic), 
        );
	}

	if( !empty($type) ){

		$resources_args['tax_query'][] = array(
            'taxonomy' => 'content-type',
            'field'    => 'term_id',
            'terms'    => array($type), 
        );
	} 
	
	$resources_loop = new WP_Query( $resources_args );

	$return_content = array('content' => '', 'load_more' => 'nomore');

	if( $resources_loop->have_posts() ){

		ob_start();

		if( $pagenumber == 1 ){ ?>

			<div class="row g-lg-5">
		<?php }
			while( $resources_loop->have_posts() ){
				$resources_loop->the_post();

				$post_image = has_post_thumbnail() ? get_the_post_thumbnail_url() : DEFAULT_IMG;
				$post_content = get_the_content();
                $post_content = strip_tags($post_content);

                if (strlen($post_content) > 125) {
                    $post_content = substr($post_content, 0, 125);
                } ?>

				<div class="col-md-6 col-xl-4">
                    <div class="info-box">
                    	<a href="<?php the_permalink(); ?>" class="text-decoration-none blog-img">     
                            <img src="<?php echo $post_image; ?>" class="img-fluid" alt="">
                        </a>
                        <div class="info-description-wrap">
                            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                <h4><?php the_title(); ?></h4>
                            </a>
                            <div class="info-description">
                                <p><?= $post_content . '...'; ?></p>
                            </div>
                            <a class="readmore" href="<?php the_permalink(); ?>">Read More <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-right.svg" class="img-fluid" alt=""></a>
                        </div>
                    </div>
                </div>
			<?php }
		if( $pagenumber == 1 ){ ?>
			
			</div>
		<?php }
		$return_content['content'] = ob_get_contents();
		ob_end_clean();

		if( $resources_loop->found_posts > ($ppp*$pagenumber) ){
			
			$return_content['load_more'] = '<a href="#" class="btn blue-btn resources-load-more navyblue-btn" data-pagenumber="'. ($pagenumber+1) .'">Load More<img src="'. get_stylesheet_directory_uri() .'/images/arrow-right.png" class="img-fluid btn-arrow" alt=""></a>';
		}

	}else{
		$return_content['content'] = 'No resources found!';
	}

	wp_reset_query();

	echo json_encode($return_content);

die();
}

if( function_exists('acf_add_options_page') ){

	acf_add_options_page(array(
		'page_title' => 'Website Settings',
		'menu_title' => 'Website Settings',
		'menu_slug' => 'website-settings',
		'capability' => 'edit_posts',
		'icon_url' => 'dashicons-layout',
		'redirect' => false
	));

	acf_add_options_page(array(
		'page_title' => 'Admin Settings',
		'menu_title' => 'Admin Settings',
		'menu_slug' => 'admin-settings',
		'capability' => 'edit_posts',
		'icon_url' => 'dashicons-admin-generic',
		'redirect' => false
	));
}

// Shortcode for br
add_shortcode('br', 'br_cb');
function br_cb(){

	return '<br>';
}

add_filter('excerpt_more', 'luca_excerpt_more');
function luca_excerpt_more( $more ) {
    return '...';
}

add_filter('get_the_excerpt', 'luca_change_excerpt');
function luca_change_excerpt( $text ){

    return rtrim( str_replace(array('[', ']'), array('', ''), $text));
}

add_filter( 'excerpt_length', 'luca_excerpt_length', 999 );
function luca_excerpt_length( $length ) {
    return 30;
}

// Dynamically popuplate dropdown section field 1
add_filter('acf/load_field/name=link_1_value', 'acf_load_dropdown1_values');
function acf_load_dropdown1_values( $field ) {
    
    $field['choices'] = array();
    $field['choices'][ '' ] = 'Select Value';

    if( have_rows('dropdown_1', 'options') ) {
        
        while( have_rows('dropdown_1', 'options') ) {  
            the_row();
               
            $value = get_sub_field('dropdown_1_value');

            $field['choices'][ $value ] = $value;   
        }
    }

    return $field;
}

// Dynamically popuplate dropdown section field 2
add_filter('acf/load_field/name=link_2_value', 'acf_load_dropdown2_values');
function acf_load_dropdown2_values( $field ) {
    
    $field['choices'] = array();
    $field['choices'][ '' ] = 'Select Value';

    if( have_rows('dropdown_2', 'options') ) {
        
        while( have_rows('dropdown_2', 'options') ) {  
            the_row();
               
            $value = get_sub_field('dropdown_2_value');

            $field['choices'][ $value ] = $value;   
        }
    }

    return $field;
}

// Theme Updater
require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$myUpdateChecker = PucFactory::buildUpdateChecker('https://github.com/BizInk/strategic',__FILE__,'strategic');
// Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');
// Using a private repository, specify the access token 
$myUpdateChecker->setAuthentication('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');