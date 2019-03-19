
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
    wp_enqueue_script( 'owl-carousel'  , get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), 1.0, false );    

    global $wp_query;
    wp_localize_script( 'main-js', 'commentForm', 
                        array( 'comment_url' => admin_url( 'admin-ajax.php' ) ,
                               'query_vars' => json_encode($wp_query -> $query)) 
                       );
}
/*
|----------------------
| ENQUEUING STYLES
|----------------------
*/
function treadly_reviews_styles() {
    wp_enqueue_style( 'google-fonts' , 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), 20141119 );
    wp_enqueue_style( 'bootstrap-css'  , get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), 1.0 );
    wp_enqueue_style( 'styles-css_1'     , get_stylesheet_directory_uri() . '/css/style_1.css', array(), 1.0 );

    wp_enqueue_style( 'component-css', get_stylesheet_directory_uri() . '/css/component.css',     array(), 20141119 );
    wp_enqueue_style( 'owl-carousel' , get_stylesheet_directory_uri() . '/css/owl.carousel.css',  array(), 20141119 );
    wp_enqueue_style( 'styles-css'   , get_stylesheet_directory_uri() . '/css/styles.css',        array(), 20141119 );
    wp_enqueue_style( 'styles2-css'   , get_stylesheet_directory_uri() . '/css/style2.css',       array(), 20141119 );
}
add_action('wp_enqueue_scripts', 'treadly_reviews_scripts');
add_action('wp_enqueue_scripts', 'treadly_reviews_styles');

add_action( 'wp_ajax_insertComment', 'insertComment' );
add_action( 'wp_ajax_nopriv_insertComment', 'insertComment' );

add_action( 'wp_ajax_updateLikes', 'updateLikes');
add_action( 'wp_ajax_nopriv_updateLikes', 'updateLikes' );
/*
|--------------------------
|   Fetching Products
|--------------------------
*/
function make_Query($key) {
    if(empty($_POST[$key]))
        return [];
    $values = array();
    $index = 0;
    foreach($_POST[$key] as $val){
        $compare = ($key == 'price') ? ($index == 0 ? '>=' : '<='): 'LIKE';        
        array_push($values,  array( 'key' => $key ,'value' => $val , 'compare'=> $compare , 'type' => ($key == 'price') ? 'NUMERIC' : ''));
        $index++;
    }
    return array('relation' => 'OR', $values);
}


function getQuery() {

    $brand     =  make_Query('brand')  ;
    $model     =  make_Query('model')  ;
    $category  =  make_Query('category');
    $minPrice  =  make_Query('price') ;
    
    $args =  '';    
    
    if(empty($_POST['brand']) && empty($_POST['model']) && empty($_POST['category']) && empty($_POST['price'])){
       $args = []; 
    } 
    if(!empty($_POST['brand']) && empty($_POST['model']) && empty($_POST['category']) && empty($_POST['price'])){
        $args =  array(
            'numberposts'	=> -1,
            'post_status'   => 'publish',
            'post_type'		=> 'post',
            'meta_query'    => $brand
        );       
    }    
    else if(empty($_POST['brand']) && !empty($_POST['model']) && empty($_POST['category']) && empty($_POST['price'])){
        $args =  array(
                'numberposts'	=> -1,
                'post_status'        => 'publish',
                'post_type'		=> 'post',
                'meta_query'    => $model
            );  
    }    
    else if(empty($_POST['brand']) && empty($_POST['model']) && !empty($_POST['category']) && empty($_POST['price'])){
        $args =  array('numberposts'	=> -1,
                        'post_status'        => 'publish',
                        'post_type'		=> 'post',
                        'meta_query'    => $category
                    );    
    }    
    else if(empty($_POST['brand']) && empty($_POST['model']) && empty($_POST['category']) && !empty($_POST['price'])){
        $args =  array('numberposts'	=> -1,
                        'post_status'        => 'publish',
                        'post_type'		=> 'post',
                        'meta_query'    => $price
                    );    
    }  
    else {
        $args = array('numberposts'	=> -1,
                      'post_status' => 'publish',
                      'post_type'	=> 'post',
                      'meta_query'	=> array(
                      'relation'	=> 'AND',
                       $brand, $model, $category ,$price));   
    }    
    return $args;
}

function fetchReviews(){

    $args = getQuery();
    if(empty($args)){
        return [];
    }

    $the_query = new WP_Query($args);
    $reviews = array();
    $response = array();

    if ($the_query->have_posts()) {
        
        while( $the_query -> have_posts() ) {            
            $the_query -> the_post();            
            $title         =  get_the_title();
            $custom_fields = get_field_objects(); 
            $reviews[]    =  array('id' => get_the_ID() , 'title' => get_the_title() , 'custom_fields' => $custom_fields );
        }
        $response['success']    = true;
        $response['reviews']   = $reviews;
        echo json_encode($response);
        exit();
    }
  else  {
        $response['success']  = false;
        $response['reviews'] = [];
        echo json_encode($response);
        exit();
    }
  wp_reset_postdata(); 
  die();
}

function insertComment(){
    $data = array(
        'comment_post_ID' => $_POST['post_id'],
        'comment_author'  => $_POST['author_name'],
        'comment_author_email' => $_POST['author_email'],
        'comment_author_url' => '',
        'comment_content' => $_POST['comment'],
        'comment_author_IP' => '',
        'comment_agent' => '',
        'comment_date' => date('Y-m-d H:i:s'),
        'comment_date_gmt' => date('Y-m-d H:i:s'),
        'comment_approved' => 1,
    );    
    $comment_id = wp_insert_comment($data);
    $success = $comment_id ? true : false;
    echo json_encode(['comment_id' => $comment_id , 'success' => $success]);
    exit();
}

function updateLikes() {
    $response = '';
    $field = get_field_object($_POST['field'] , $_POST['post_id']);
    
    $count = (int) $field['value'];
    $count = ( $count == 0 ) ? 1 : $count++;

    $response = update_field($field['key'], $count, (int) $_POST['post_id']);               
    
    echo json_encode(array('response' => $response, 'count'=> $count, 'key' => $field['key'] , 'value' => $field['value'] , 'post_id' => $_POST['post_id']));
    exit();
}
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
