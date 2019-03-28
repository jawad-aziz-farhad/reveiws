<?php
// Register Custom Navigation Walker
//require_once 'class-wp-bootstrap-navwalker.php';
/*
|----------------------
| ENQUEUING SCRIPTS
|----------------------
*/
function treadly_reviews_scripts(){
    wp_enqueue_script( 'jquery',      'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), 1.0, false );
    wp_enqueue_script( 'bootstrap-js'  , get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), 1.0 , false);
    wp_enqueue_script( 'main-js'       , get_template_directory_uri() . '/js/main.js', array('jquery'), 1.0 , false);
    global $wp_query;
    wp_localize_script( 'main-js', 'commentForm', 
                        array( 'comment_url' => admin_url( 'admin-ajax.php' ) ,
                               'query_vars' => json_encode($wp_query -> $query)) 
                       );
}

/*
|----------------------------
| ENABLING THREADED COMMENTS
|----------------------------
*/
function enable_threaded_comments(){
    if (!is_admin()) {
         if (is_singular() && comments_open() && (get_option('thread_comments') == 1))
              wp_enqueue_script('comment-reply');
         }
    }
    
add_action('get_header', 'enable_threaded_comments');
/*
|----------------------
| ENQUEUING STYLES
|----------------------
*/
function treadly_reviews_styles() {
    wp_enqueue_style( 'google-fonts' , 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), 1.0 );
    wp_enqueue_style( 'bootstrap-css'  , get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), 1.0 );
    wp_enqueue_style( 'styles-css'     , get_stylesheet_directory_uri() . '/css/style.css', array(), 1.0 );
}
add_action('wp_enqueue_scripts', 'treadly_reviews_scripts');
add_action('wp_enqueue_scripts', 'treadly_reviews_styles');

add_action( 'wp_ajax_insertComment', 'insertComment' );
add_action( 'wp_ajax_nopriv_insertComment', 'insertComment' );

add_action( 'wp_ajax_updateLikes', 'updateLikes');
add_action( 'wp_ajax_nopriv_updateLikes', 'updateLikes' );

add_action( 'wp_ajax_searchReview', 'searchReview');
add_action( 'wp_ajax_nopriv_searchReview', 'searchReview' );
/*
|--------------------------
|   Fetching Products
|--------------------------
*/

function getQuery() {
    $brand     =  $_POST['brand'] ? array( 'key' => 'brand' ,'value' => $_POST['brand'] , 'compare'=> 'LIKE' ) : []  ;
    $model     =  $_POST['model'] ? array( 'key' => 'model' ,'value' => $_POST['model'] , 'compare'=> 'LIKE' ) : []  ; 
    $category  =  $_POST['category'] ? array( 'key' => 'category' ,'value' => $_POST['category'] , 'compare'=> '=' ) : [] ; 
    $price     =  array(
	    'relation'  => 'AND',
        $_POST['price_min'] ? array('key'	=> 'price','compare' => '>=','value' => $_POST['price_min'] ,'type' => 'NUMERIC') : [],
        $_POST['price_max'] ? array('key'	=> 'price','compare' => '<=','value' => $_POST['price_max'] ,'type' => 'NUMERIC') : []
	);
    
    $args =  '';
    if(empty($_POST['brand']) && empty($_POST['model']) && empty($_POST['category']) && empty($_POST['price_min']) && empty($_POST['price_max']) ){
       $args = []; 
    } 
    if(!empty($_POST['brand']) && empty($_POST['model']) && empty($_POST['category']) && empty($_POST['price_min']) && empty($_POST['price_max']) ){
        $args =  array(
            'numberposts'	=>  -1,
            'post_status'   => 'publish',
            'meta_key'		=> 'brand',
            'meta_value'    => $_POST['brand']
        );       
    }    
    else if(empty($_POST['brand']) && !empty($_POST['model']) && empty($_POST['category']) && empty($_POST['price_min']) && empty($_POST['price_max'])){
        $args =  array(
                'numberposts'	=> -1,
                'post_status'   => 'publish',
                'post_type'		=> 'post',
                'meta_key'		=> 'model',
                'meta_value'    => $_POST['model']
            );  
    }    
    else if(empty($_POST['brand']) && empty($_POST['model']) && !empty($_POST['category']) && empty($_POST['price_min']) && empty($_POST['price_max'])){
        $args =  array('numberposts'	=> -1,
                        'post_status'   => 'publish',
                        'post_type'		=> 'post',
                        'meta_key'		=> 'category',
                        'meta_value'    => $_POST['category']
                    );    
    }    
    else if(empty($_POST['brand']) && empty($_POST['model']) && empty($_POST['category']) && (!empty($_POST['price_min']) || !empty($_POST['price_max']))){
        $args =  array('numberposts'	=> -1,
                        'post_status'   => 'publish',
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
function searchReview(){
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
            $author_id = get_post_field( 'post_author', get_the_ID() );
            $author_name  = get_the_author_meta('user_nicename', $author_id);
            $comments_count = wp_count_comments( get_the_ID() )->approved;
            $reviews[]     =  array('id' => get_the_ID() , 'author' => get_field('name') , 'comments'=> $comments_count ,'custom_fields' => $custom_fields );
        }
        $response['success']   = true;
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

function updateCustomField($field , $increment = true) {
    $field = get_field_object($field , $_POST['post_id']);    
    $count = (int) $field['value'];    
    $count = $increment ? ($count + 1 ) : ($count - 1);
    $response = update_field($field['key'], $count, $_POST['post_id']);
    return $response;
}

function updatePostMeta($field){
    $metaKey   = $field == 'review_likes' ? get_current_user_id() . '_like' : get_current_user_id() . '_dislike';
    update_post_meta($_POST['post_id'] , $metaKey , true);

    $postMetaLike    = get_post_meta($_POST['post_id'] , get_current_user_id() . '_like'    , true);
    $postMetaDisLike = get_post_meta($_POST['post_id'] , get_current_user_id() . '_dislike' , true);

    if($field == 'review_likes' && $postMetaDisLike == 1){
        delete_post_meta($_POST['post_id'] , get_current_user_id() . '_dislike');    
        updateCustomField('review_dislikes', false);
    }
    else if($field == 'review_dislikes' && $postMetaLike == 1){
        delete_post_meta($_POST['post_id'] , get_current_user_id() . '_like');
        updateCustomField('review_likes', false);
    }
}

function updateLikes() {
    
    updatePostMeta($_POST['field']);
    $response = updateCustomField($_POST['field'] , true);
    
    echo json_encode(array('response' => $response, 
                           'likes'=> get_field('review_likes', $_POST['post_id']) , 
                           'dislikes' => get_field('review_dislikes', $_POST['post_id'])));
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

function my_custom_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
   <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="<?php echo um_get_user_avatar_url();?>" width="40" height="40" alt="">
        <div class="media-body">
        <h5 class="mt-0"><?php echo $comment->comment_author; ?></h5>
        <?php echo $comment->comment_content; ?>
        </div>
    </div>

   <?php if ($comment->comment_approved == '0') : ?>
      <em><?php _e('Your comment is awaiting moderation.') ?></em>
   <?php endif; 
 }

function initTheme(){
    add_theme_support( 'menus' ); 
    register_nav_menu( 'primary', 'Header Menu');
    register_nav_menu( 'secondary', 'Footer Menu');
}
add_action('init', 'initTheme'); 


?>