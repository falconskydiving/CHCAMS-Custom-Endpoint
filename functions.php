<?php
/**
 * chcams functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package chcams
 */

if ( ! function_exists( 'chcams_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function chcams_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on chcams, use a find and replace
		 * to change 'chcams' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'chcams', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'chcams' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'chcams_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'chcams_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function chcams_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'chcams_content_width', 640 );
}
add_action( 'after_setup_theme', 'chcams_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function chcams_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'chcams' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'chcams' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => 'Topbar Sidebar',
		'id' => 'topbar',
		'description' => 'Appears below navigation',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'chcams_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function chcams_scripts() {
	wp_enqueue_style( 'chcams-style', get_stylesheet_uri() );

	wp_enqueue_script( 'chcams-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'chcams-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'chcams_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Register footer widgets
 */
register_sidebar( array(
	'name' => 'Footer Sidebar Left',
	'id' => 'footer-sidebar-left',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'name' => 'Footer Sidebar Middle',
	'id' => 'footer-sidebar-middle',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array(
	'name' => 'Footer Sidebar Right',
	'id' => 'footer-sidebar-right',
	'description' => 'Appears in the footer area',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) ); 

/*Board Member Login Sidebar*/
register_sidebar( array(
	'name' => 'Board Member Login Sidebar',
	'id' => 'board-member-sidebar',
	'description' => 'Sidebar for the board member login page.',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

/* New excerpt length of 20 words*/
function my_excerpt_length($length) {
return 20;
}
add_filter('excerpt_length', 'my_excerpt_length');

add_role('board_member', __(
    'Board Member'),
    array(
        'read'               => true,
        'read_private_pages' => true, 
        'read_private_posts' => true
        )
);

add_role('hr', __(
    'Human Resources'),
    array(
        'read'               => true,
        'read_private_pages' => true, 
        'read_private_posts' => true,
		'edit_posts' => true
        )
);

/*Gravity Form Dynamic Population*/
/*add_filter( 'gform_field_value_county', 'my_custom_population_function' );
if ($county == 'Amite') 
{
	echo "Amite County Medical Services, Inc.";
	exit;
}

add_filter( 'widget_text', 'do_shortcode' );*/


function clinical_locations_get_endpoint_phrase() {
    $health_center = get_page_by_path( '/browse-community-health-centers/', OBJECT, 'page' );
    $page_content = json_encode($health_center->post_content);

	$needle = '[vc_tta_section title=\"';

	$lastPos = 0;
	$positions = array();

	while (($lastPos = strpos($page_content, $needle, $lastPos))!== false) {
	    $positions[] = $lastPos;
	    $lastPos = $lastPos + strlen($needle);
	}

	$clinicalLocations = array();
	$index = 1;
	foreach ($positions as $position) {

		if(count($positions) == $index)
			$block_string = substr($page_content, $position, strlen($page_content)-$position);
		else
			$block_string = substr($page_content, $position, $positions[$index]-$position);

		$count_block = substr_count($block_string,"[vc_column_text]");

		// return rest_ensure_response("success! => ");
		$location_title_last_pos = stripos($page_content, '\"', $position + 24);
		$location_title = substr($page_content, $position+24, $location_title_last_pos - $position-24);

		$location_address1_first_pos = stripos($page_content, '[vc_column_text]', $position) + 16;
		$location_address1_last_pos = stripos($page_content, "\\r\\n", $location_address1_first_pos);
		$location_address1 = substr($page_content, $location_address1_first_pos, $location_address1_last_pos - $location_address1_first_pos);

		$location_address2_first_pos = $location_address1_last_pos + 4;
		$location_address2_last_pos = stripos($page_content, "\\r\\n\\r\\n", $location_address2_first_pos);
		$location_address2 = substr($page_content, $location_address2_first_pos, $location_address2_last_pos - $location_address2_first_pos);	


		$location_phone_first_pos = stripos($page_content, 'Phone', $location_address2_last_pos) + 6;
		$location_phone_last_pos = stripos($page_content, "\\r\\n", $location_phone_first_pos);
		$location_phone = trim(substr($page_content, $location_phone_first_pos, $location_phone_last_pos - $location_phone_first_pos));


		$location_fax_first_pos = stripos($page_content, 'Fax', $location_address2_last_pos) + 4;
		$location_fax_last_pos = stripos($page_content, "\\r\\n", $location_fax_first_pos);
		$location_fax = trim(substr($page_content, $location_fax_first_pos, $location_fax_last_pos - $location_fax_first_pos));

		$location_website_first_pos = stripos($page_content, '\">', $location_address2_last_pos) + 3;
		$location_website_last_pos = stripos($page_content, '<\/a>', $location_website_first_pos);
		$location_website = trim(substr($page_content, $location_website_first_pos, $location_website_last_pos - $location_website_first_pos));

		$location_mail_first_pos = stripos($page_content, 'mailto:', $location_phone_last_pos) + 7;
		$location_mail_last_pos = stripos($page_content, '\"', $location_mail_first_pos);
		$location_mail = trim(substr($page_content, $location_mail_first_pos, $location_mail_last_pos - $location_mail_first_pos));

		$location_inner_text = array();

		$sub_position = $position;

		for( $k = 0 ; $k < $count_block; $k++ )
		{
			$sub_inner_text = "";
			$sub_first_point = stripos($page_content, '[vc_column_text]', $sub_position) + 16;
			$sub_last_point = stripos($page_content, "[\/vc_column_text]", $sub_first_point);

			$sub_inner_text = trim(substr($page_content, $sub_first_point, $sub_last_point - $sub_first_point));

			$sub_inner_text = str_replace("\/", "/", $sub_inner_text);
			$sub_inner_text = str_replace("\\r\\n", "<br/>", $sub_inner_text);
			$sub_inner_text = str_replace("href=", "hrefnone=", $sub_inner_text);

			if(substr_count($sub_inner_text, ">LOCATIONS<") > 0)
			{
				$sub_inner_text = str_replace(">LOCATIONS<", "><", $sub_inner_text);
			}

			array_push($location_inner_text, $sub_inner_text);

			$sub_position = $sub_last_point;
		}

		$address = str_replace(" ", "%20", $location_address1."%20".$location_address2);

		$state_code = '';

		if(strpos($location_address2, 'MS') !== false){
			$state_code = 'MS';
		}elseif (strpos($location_address2, 'ALA') !== false) {
			$state_code = 'ALA';
		}

		$strs = explode($state_code, $location_address2);


		$display_address = $location_address1 . ' ' . $strs[0]. $state_code;
		$city = trim(explode(',', $strs[0])[0]);
		$zip_code = trim($strs[1]); 

		$url = "https://maps.google.com/maps/api/geocode/json?address=".$address."&sensor=false&region=US&key=AIzaSyCq7XfTNjvaYikxtNIScH_YB8CrRSnbAw8";

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$responseJson = json_decode(curl_exec($ch), true);
		curl_close($ch);

		array_push($clinicalLocations, array(
			'index'					=>	$index,
			'name'					=>	$location_title,
			'address1'				=>	$location_address1,
			'address2'				=>	$location_address2,
			'phone'					=>	$location_phone,
			'fax'					=>	$location_fax,
			'website'				=>	$location_website,
			'mail'					=>	$location_mail,
			'count_block'			=>	$count_block,
			'location_inner_text' 	=> 	$location_inner_text,
			'latlng'	=>	array(
				'latitude'			=>	(float)$responseJson['results'][0]['geometry']['location']['lat'],
				'longitude'			=>	(float)$responseJson['results'][0]['geometry']['location']['lng'],
				'latitudeDelta'		=>	0.0922,
				'longitudeDelta'	=>	0.0421
			),
			'address'				=> 	$address,
			'display_address'		=>	$display_address,
			'state_code'			=>	$state_code,
			'city' 					=> 	$city,
			'zip_code'				=>	$zip_code,
			'searchable_title'		=>	$location_title . ' | ' . $location_address1.' '.$location_address2,
		));

	    $index++;
	}
	return rest_ensure_response($clinicalLocations);
}

function clinical_locations_routes() {
    register_rest_route( 'clinical-locations/v1', '/retrieve', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => WP_REST_Server::READABLE,
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'clinical_locations_get_endpoint_phrase',

    ));
}

add_action( 'rest_api_init', 'clinical_locations_routes' );


function resources_get_endpoint_phrase() {
	$menu = wp_get_nav_menu_object("Primary Menu" );
	$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC') );
	$forhealthcenters = array();
	$index = 11111;
	foreach( $menuitems as $menuitem ) {
		if($menuitem->menu_item_parent == "194"){
			array_push($forhealthcenters, 
				array(
					"key"	=>	$index,
					"title" =>	$menuitem->title,
					"url"	=>	$menuitem->url,
				)
			);
			$index++;
		}
	}

	return rest_ensure_response($forhealthcenters);
}

function resources_for_health_centers_routes() {
    register_rest_route( 'resources-for-health-centers/v1', '/retrieve', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => WP_REST_Server::READABLE,
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'resources_get_endpoint_phrase',
    ));
}

add_action( 'rest_api_init', 'resources_for_health_centers_routes' );



function newsletters_get_endpoint_phrase() {

	$newsletters = get_page_by_path( '/newsletters/', OBJECT, 'page' );
    $page_content = json_encode($newsletters->post_content);

    $start_position = stripos($page_content, '[vc_row_inner]', 0);
    $end_position = stripos($page_content, '[\/vc_row_inner]', 0);
	$block_string = substr($page_content, $start_position, $end_position-$start_position);
	$count_block = substr_count($block_string,"[vc_column_text]");

	$newsletters_text = "";
	$sub_position = 0;
	for( $k = 0 ; $k < $count_block ; $k++ )
	{
		$sub_begin_position = stripos($block_string, '[vc_column_text]', $sub_position) + 16;
		$sub_end_position = stripos($block_string, '[\/vc_column_text]', $sub_begin_position);
		$sub_newsletter_text = trim(substr($block_string, $sub_begin_position, $sub_end_position - $sub_begin_position));

		$newsletters_text .= $sub_newsletter_text;//($k+1)."==================================>".
		$sub_position = $sub_end_position;
	}

	$newsletters = array();

	$newsletters_temp = explode("<a ", $newsletters_text);
	for($i=1;$i<count($newsletters_temp);$i++)
	{
		$item_url = str_replace("\/", '/', substr($newsletters_temp[$i], stripos($newsletters_temp[$i], "https:"), stripos($newsletters_temp[$i], '">') - stripos($newsletters_temp[$i], "https:")));
		 
		$item_date = substr($newsletters_temp[$i], stripos($newsletters_temp[$i], '">') + 2, stripos($newsletters_temp[$i], '<\/a') - stripos($newsletters_temp[$i], '">') - 2);
		$itme_title = str_replace('\\r\\n', '', substr($newsletters_temp[$i], stripos($newsletters_temp[$i], '<\/a>')+5, strlen($newsletters_temp[$i]) - stripos($newsletters_temp[$i], '<\/a>') - 5)); 

		if(stripos($item_url, " "))
		{
			$item_url = explode(" ", $item_url)[0];
		}

		// array_push($newsletters, "<a ". $newsletters_temp[$i]); 
		array_push($newsletters, 
			array(
				'url'	=>	$item_url,
				'date'	=>	$item_date,
				'title'	=>	$itme_title
			)
		); 
	}

	return rest_ensure_response($newsletters);
}

function newsletters_for_health_centers_routes() {
    register_rest_route( 'newsletters/v1', '/retrieve', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => WP_REST_Server::READABLE,
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'newsletters_get_endpoint_phrase',
    ));
}

add_action( 'rest_api_init', 'newsletters_for_health_centers_routes' );