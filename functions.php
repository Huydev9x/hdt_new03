<?php
// Get Pagination.
$current = 1;
$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url_array = explode('/page/', $url);
if(count($url_array) > 1) $current = (int)str_replace('/', '', $url_array[1]);
if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('huydev', get_template_directory() . '/languages');
}

// Khởi tạo các khối để kéo thả widget.
if (function_exists('register_sidebar'))
{
}

// Load jQuery
if ( !is_admin() ) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"), false);
    wp_enqueue_script('jquery');
}

// Clean up the <head>
function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');


// Register Navigation menu.
if(function_exists('register_nav_menus')){
    register_nav_menus(array(
        'header_main_menu' => __('Header Main Menu', 'huydev'),
        'footer_menu1' => __('Footer Menu 1', 'huydev'),
        'footer_menu2' => __('Footer Menu 2', 'huydev'),
        'footer_menu3' => __('Footer Menu 3', 'huydev'),
        'footer_menu4' => __('Footer Menu 4', 'huydev'),
        'footer_menu5' => __('Footer Menu 5', 'huydev'),
        'footer_menu6' => __('Footer Menu 6', 'huydev'),
    ));
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Sidebar', 'huydev'),
        'description' => __('Kéo thả nội dung vào khối này', 'huydev'),
        'id' => 'widget-sidebar',
        'before_widget' => '<section class="sidebar-item">',
        'after_widget' => '</section>',
        'before_title' => '<section class="sidebar-item-head tf">',
        'after_title' => '</section>'
    ));
}

// Remove thumbnail size.
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Custom get term.
function get_term_custom($id, $taxonomy){
    $result = '';
    $current_term = get_the_terms( $id, $taxonomy );
    if(!empty($current_term) && count($current_term) > 0){
        $result .= '<a class="tag" href="'.get_term_link((int)$current_term[0]->term_id, $taxonomy).'">'.$current_term[0]->name.'</a>';
    }
    return $result;
}

function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// Get View.
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

// Remove canonical header.
function at_remove_dup_canonical_link() {
    return false;
}
add_filter( 'wpseo_canonical', 'at_remove_dup_canonical_link' );

// Classic Editor.
add_filter('use_block_editor_for_post', '__return_false');

// Option config website.
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Cấu hình website',
        'menu_title'    => 'Cấu hình website',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'  => false
    ));
}
// Send Mail SMTP.
function send_smtp_email( $phpmailer ) {
  $phpmailer->IsSMTP();
  $phpmailer->Host       = "smtp.gmail.com";
  $phpmailer->Port       = 465;
  $phpmailer->SMTPAuth   = true;
  $phpmailer->Username   = get_field('email_app', 'option'); //tai khoan
  $phpmailer->Password   = get_field('password_app', 'option'); //mat khau
  $phpmailer->SMTPSecure = "ssl";
}
add_action( 'phpmailer_init', 'send_smtp_email' );