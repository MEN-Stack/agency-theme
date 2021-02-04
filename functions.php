<?php
add_action( 'after_setup_theme', 'hastings_setup' );
function hastings_setup() {
load_theme_textdomain( 'hastings', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form' ) );
global $content_width;
if ( ! isset( $content_width ) ) { $content_width = 1920; }

register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'hastings' ) ) );
}

add_action( 'wp_enqueue_scripts', 'hastings_load_scripts' );
function hastings_load_scripts() {
wp_enqueue_style( 'hastings-style', get_stylesheet_uri() );
wp_enqueue_style ( 'styles', get_theme_file_uri('/html/style/stylesheets/screen.css'), array () );
wp_enqueue_script( 'jquery' );
}

add_action( 'wp_footer', 'hastings_footer_scripts' );
function hastings_footer_scripts() {
?>
<script>
jQuery(document).ready(function ($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
$("html").addClass("mobile");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
<?php } ?>
<?php
//clean up wp_nav_menu
function wp_nav_menu_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}
add_filter('nav_menu_css_class', 'wp_nav_menu_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'wp_nav_menu_attributes_filter', 100, 1);
add_filter('page_css_class', 'wp_nav_menu_attributes_filter', 100, 1);
// custom menu 
function clean_custom_menus() {
	$menu_name = 'main-menu'; // specify custom menu slug
	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);
        ?> <button class="menu-button mobile"></button> <?php
		// $menu_list = '<nav>' ."\n";
		$menu_list .= "\t\t\t\t". '<ul class="site-menu desktop">' ."\n";
		foreach ((array) $menu_items as $key => $menu_item) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$menu_list .= "\t\t\t\t\t". '<li><a href="'. $url .'">'. $title .'</a></li>' ."\n";
        }
        $menu_list .= "\t\t\t\t". '<li class="work-with-us"><a>Work With Us</a></li>';
		$menu_list .= "\t\t\t\t". '</ul>' ."\n";
		// $menu_list .= "\t\t\t". '</nav>' ."\n";
	} else {
		// $menu_list = '<!-- no list defined -->';
	}
	echo $menu_list;
}

//setup PROJECT post type
function project_post_type() {
    $args = array(
        'public'    => true,
        'label'     => __( 'Projects', 'textdomain' ),
        'menu_icon' => 'dashicons-portfolio',
        'show_in_rest' => true,
        'has_archive' => true,
        'taxonomies' => array('post_tag', 'category'),
        'supports' => array(
            'title', 
            'editor', 
            'custom-fields', 
            'thumbnail',
            'excerpt',
            'categories'
        )
    );
    register_post_type( 'project', $args );
}
add_action( 'init', 'project_post_type' );

//setup HERO post type
function hero_post_type() {
    $args = array(
        'public'    => true,
        'label'     => __( "Hero's", 'textdomain' ),
        'menu_icon' => 'dashicons-format-image',
        'show_in_rest' => true,
        'has_archive' => true,
        'taxonomies' => array('post_tag','category'),
        'supports' => array(
            'title', 
            'editor', 
            'custom-fields', 
            'thumbnail',
            'excerpt',
        )
    );
    register_post_type( 'hero', $args );
}
add_action( 'init', 'hero_post_type' );

//setup FOOTER post type
function footer_post_type() {
    $args = array(
        'public'    => true,
        'label'     => __( "Footer's", 'textdomain' ),
        'menu_icon' => 'dashicons-align-left',
        'show_in_rest' => true,
        'has_archive' => true,
        'taxonomies' => array('post_tag','category'),
        'supports' => array(
            'title', 
            'editor', 
            'custom-fields', 
            'thumbnail',
            'excerpt',
        )
    );
    register_post_type( 'footer', $args );
}
add_action( 'init', 'footer_post_type' );

// register custom taxonomy
function create_project_type_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Project Types', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Project Type', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Project Types', 'textdomain' ),
        'all_items'         => __( 'All Project Types', 'textdomain' ),
        'parent_item'       => __( 'Parent Project Type', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Project Type:', 'textdomain' ),
        'edit_item'         => __( 'Edit Project Type', 'textdomain' ),
        'update_item'       => __( 'Update Project Type', 'textdomain' ),
        'add_new_item'      => __( 'Add New Project Type', 'textdomain' ),
        'new_item_name'     => __( 'New Project Type Name', 'textdomain' ),
        'menu_name'         => __( 'Project Type', 'textdomain' ),
    );
 
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'show_in_rest'      => true,
        'rewrite'           => array( 'slug' => 'project type' ),
    );
 
    register_taxonomy( 'Project_Type', array('post','page','project'), $args );
}
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_project_type_taxonomies', 0 );

function cat_query($category,$quantity){
    $args = ( array(
        'category_name'  => $category,
        'posts_per_page' => $quantity
    ) );
    $posts = query_posts($args);
    return $posts;
}