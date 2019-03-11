
<?php
/*
|----------------------
| ENQUEUING SCRIPTS
|----------------------
*/
function treadly_reviews_scripts(){
    wp_enqueue_script( 'jquery',      'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), 1.0, false );
    wp_enqueue_script( 'bootstrap-js'  , get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), 1.0 , false);
    wp_enqueue_script( 'main-js'       , get_template_directory_uri() . '/js/main.js', array('jquery'), 1.0 , false);
}
/*
|----------------------
| ENQUEUING STYLES
|----------------------
*/
function treadly_reviews_styles(){
    wp_enqueue_style( 'google-fonts' , 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), 20141119 );
    wp_enqueue_style( 'bootstrap-css'  , get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), 1.0 );
    wp_enqueue_style( 'styles-css'     , get_stylesheet_directory_uri() . '/css/style.css', array(), 1.0 );
}
add_action('wp_enqueue_scripts', 'treadly_reviews_scripts');
add_action('wp_enqueue_scripts', 'treadly_reviews_styles');
/*
|------------------------------------
|  ADDING THEME SUPPORT FEATURES
|------------------------------------
*/
function custom_func_setup(){
    $logoData = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' )
    );    
    add_theme_support('custom-logo', $logoData);

    $headerData = array(
        'width' => 1460,
        'flex-width'    => true,
        'height'=> 60,
        'flex-height'    => true,
        'default-image' => get_template_directory_uri() . '/images/cycle-bg-1.jpg'
    );    
    add_theme_support('custom-header',$headerData);
    
    $headerImages = array(
    'image1' => array(
        'url' =>  get_template_directory_uri() . '/images/cycle-bg-1.jpg',
        'thumbnail_url' => get_template_directory_uri() . '/images/cycle-bg-1.jpg',
        'description' => '1st suggestion'
    ),
    'image2' => array(
        'url' =>  get_template_directory_uri() . '/images/cycle-bg-2.jpg',
        'thumbnail_url' => get_template_directory_uri() . '/images/cycle-bg-2.jpg',
        'description' => '2nd suggestion'
    )
    );    
    register_default_headers($headerImages);

    $backgroundData = array(
        'default-color'          => '',
        'default-image'          => '%1$s/images/cycle-bg-1.jpg',
        'default-repeat'         => 'no-repeat',
        'default-position-x'     => 'left',
        'default-position-y'     => 'top',
        'default-size'           => 'cover',
        'default-attachment'     => 'scroll',
        'wp-head-callback'       => '_custom_background_cb',
        'admin-head-callback'    => '',
        'admin-preview-callback' => ''
    );
    add_theme_support( 'custom-background', $backgroundData );
}

add_action( 'after_setup_theme', 'custom_func_setup' );

add_theme_support( 'custom-background' );
add_theme_support( 'post-formats', array('aside', 'image', 'video'));

add_theme_support( 'post-thumbnails', array( 'post', 'page' , 'movie' ) );   

function initTheme(){
    add_theme_support( 'menus' ); 
    register_nav_menu( 'primary', 'Primary Header Navigation');
    register_nav_menu( 'secondary', 'Footer Navigation Menu');
}
add_action('init', 'initTheme'); 

?>