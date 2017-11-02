<?php
/**
 * hgise functions and definitions
 *
 * @package hgise
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'hgise_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hgise_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on hgise, use a find and replace
	 * to change 'hgise' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'hgise', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'hgise' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'hgise_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // hgise_setup
add_action( 'after_setup_theme', 'hgise_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function hgise_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'hgise' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'hgise_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hgise_scripts() {
	wp_enqueue_style( 'rhino-slider', get_template_directory_uri() . '/css/rhinoslider-1.05.css');

	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css');

	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Tienne|Open+Sans:300,400,600');
	
	wp_enqueue_style( 'hgise-style', get_stylesheet_uri() );

	wp_enqueue_script( 'hgise-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'jquery-11.1.1', get_template_directory_uri() . '/js/jquery-1.11.1.min.js', array() );

	wp_enqueue_script( 'jquery-ui-js', get_template_directory_uri() . '/js/jquery-ui.min.js', array() );

	wp_enqueue_script( 'rhinoslider', get_template_directory_uri() . '/js/rhinoslider-1.05.js', array() );

	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array() );

	wp_enqueue_script( 'functions', get_template_directory_uri() . '/js/functions.js', array() );

	wp_enqueue_script( 'hgise-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hgise_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

add_action( 'init', 'create_projects_post_type' );
 
function create_projects_post_type() {
    $args = array(
                  'description' => 'Project Post Type',
                  'show_ui' => true,
                  'exclude_from_search' => true,
                  'labels' => array(
                                    'name'=> 'Projects',
                                    'singular_name' => 'Project',
                                    'add_new' => 'Add New Project',
                                    'add_new_item' => 'Add New Project',
                                    'edit' => 'Edit Projects',
                                    'edit_item' => 'Edit Project',
                                    'new-item' => 'New Project',
                                    'view' => 'View Portfolios',
                                    'view_item' => 'View Project',
                                    'search_items' => 'Search Projects',
                                    'not_found' => 'No Projects Found',
                                    'not_found_in_trash' => 'No Projects Found in Trash',
                                    'parent' => 'Parent Project'
                                   ),
                 'public' => true,
                 'capability_type' => 'post',
                 'hierarchical' => false,
                 'supports' => array('title', 'thumbnail')
                 );
                
    register_post_type( 'projects' , $args );
}

add_action( 'init', 'create_featured_maps_post_type' );
 
function create_featured_maps_post_type() {
    $args = array(
                  'description' => 'Featured Maps Post Type',
                  'show_ui' => true,
                  'exclude_from_search' => true,
                  'labels' => array(
                                    'name'=> 'Featured Maps',
                                    'singular_name' => 'Featured Map',
                                    'add_new' => 'Add New Featured Map',
                                    'add_new_item' => 'Add New Featured Map',
                                    'edit' => 'Edit Featured Maps',
                                    'edit_item' => 'Edit Featured Map',
                                    'new-item' => 'New Featured Map',
                                    'view' => 'View Featured Maps',
                                    'view_item' => 'View Featured Map',
                                    'search_items' => 'Search Featured Maps',
                                    'not_found' => 'No Featured Maps Found',
                                    'not_found_in_trash' => 'No Featured Maps Found in Trash',
                                    'parent' => 'Parent Project'
                                   ),
                 'public' => true,
                 'capability_type' => 'post',
                 'hierarchical' => false,
                 'supports' => array('title')
                 );
                
    register_post_type( 'featured-maps' , $args );
}

add_action( 'init', 'create_projects_tax' );

function create_projects_tax() {
	register_taxonomy(
		'project_type',
		'projects',
		array(
			'label' => __( 'Project type' ),
			'rewrite' => array( 'slug' => 'project_type' ),
			'hierarchical' => true,
		)
	);
}

add_action( 'init', 'create_about_post_type' );
 
function create_about_post_type() {
    $args = array(
                  'description' => 'About Post Type',
                  'show_ui' => true,
                  'exclude_from_search' => true,
                  'labels' => array(
                                    'name'=> 'About'
                                   ),
                 'public' => true,
                 'capability_type' => 'post',
                 'hierarchical' => false,
                 'rewrite' => true,
                 'supports' => array('title', 'thumbnail')
                 );
                
    register_post_type( 'about' , $args );
}

add_action( 'init', 'create_footer_post_type' );
 
function create_footer_post_type() {
    $args = array(
                  'description' => 'Footer Post Type',
                  'show_ui' => true,
                  'exclude_from_search' => true,
                  'labels' => array(
                                    'name'=> 'Footer'
                                   ),
                 'public' => true,
                 'capability_type' => 'post',
                 'hierarchical' => false,
                 'rewrite' => true,
                 'supports' => array('title', 'thumbnail')
                 );
                
    register_post_type( 'footer' , $args );
}

register_sidebar(array(
	'name' => 'sidebar-1',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));

function remove_menus() {
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit.php?post_type=page' );
	remove_menu_page( 'edit-comments.php' );
}

add_action( 'admin_menu', 'remove_menus' );


function remove_http($url) {
   $disallowed = array('http://', 'https://');
   foreach($disallowed as $d) {
      if(strpos($url, $d) === 0) {
         return str_replace($d, '', $url);
      }
   }
   return $url;
}

function aspect_ratio($img) {
	$image = getimagesize($img);
	$width = $image[0];
	$height = $image[1];
	if ($width >= $height) {
		return "landscape";
	} else {
		return "portrait";
	}
}

function img_resize($img,$new_width,$new_height) {
	$image_size = getimagesize($img);
	$image_width = $image_size[0];
	$image_height = $image_size[1];
	$image_ratio = $image_height / $image_width;
	if (isset($new_width)) {
		$resize_ratio = $image_width / $new_width;
		$new_height = round($image_width * $image_ratio / $resize_ratio);
		return $new_height;
	}
	elseif (isset($new_height)) {
		$resize_ratio = $image_height / $new_height;
		$new_width = round($image_height / $image_ratio / $resize_ratio);
		return $new_width;
	} else {
		return false;
	}
}

function search_image() {
	if ( has_post_thumbnail() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),  'medium' ); 
		return $image[0];
	} else {
		return '/wp-content/themes/hgise/images/no-image.gif';
	}
}

function bg_image($image) {
	return "background-image:url('".$image."')";
}

function video_image($url){
    $image_url = parse_url($url);
    $array = explode("&", $image_url['query']);
    if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com') {
    	return "http://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg";
	}
}

function array_icount_values($array) {
    $ret_array = array();
    foreach($array as $value) $ret_array[strtolower($value)]++;
    return $ret_array;
}

function title_and_subtitle() {
	global $title, $subtitle;
	if ( ($title != "" && $title != "_blank") || $subtitle != "" ) {
		echo '<hgroup class="title_and_subtitle">';
	}
	if ( $title != "" && $title != "_blank" ) {
		echo '<h3>'.$title.'</h3>';
	}
	if ( $subtitle != "" ) {
		echo '<h4 class="subtitle">'.$subtitle.'</h4>';
	}
	if ( ($title != "" && $title != "_blank") || $subtitle != "" ) {
		echo '</hgroup>';
	}
}

function sources_and_publications() {
	$source = false;
	$publication = false;
	while ( have_rows('project_content') ) {
		the_row();
		if ( get_row_layout() == 'sources' ) {
			if ( have_rows('source') ) {
				$sources = true;
			}
			if ( have_rows('publication') ) {
				$publication = true;
			}
		}
	}
	if($sources != true && $publication != true) {

	} else {
		$sources_and_publications = "unique";
	}
	return $sources_and_publications;
}

function counting_diagrams() {
	$diagram_c = 0;
	while ( have_rows('project_content') ) {
		the_row();
		if ( get_row_layout() == 'diagrams' ) {
			++$diagram_c;
		}
	}
	return $diagram_c;
}

function counting_tables() {
	$tables_c = 0;
	while ( have_rows('project_content') ) {
		the_row();
		if ( get_row_layout() == 'tables' ) {
			++$tables_c;
		}
	}
	return $tables_c;
}

function last_diagram($diagrams_c,$diagrams_counter) {
	if ($diagrams_c == $diagrams_counter) {
		return 'last';
	}
}

function counting_slides($items_per_slide) {
	global $items;
	$slides = (int) ($items / $items_per_slide);
	if ($slides % 3 != 0) {
		$slides = $slides + 1;
	}
	return $slides;
}

function download_link() {
	global $download;
	if ( $download != "" ) {
		$download_url = $download['url'];
		return '<div class="download"><a href="'.$download_url.'">Download set of images</a></div>';
	}
}

function three_in_row($i) {
	if (($i % 3) == 0 ) {
		return 'first-in-row';	
	} elseif (($i % 3) == 2 ) {
		return 'last-in-row';
	} else {
		return 'middle-in-row';
	}
}

?>
