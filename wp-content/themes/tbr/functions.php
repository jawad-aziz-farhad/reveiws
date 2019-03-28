<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'twentynineteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twentynineteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

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
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'twentynineteen' ),
				'footer' => __( 'Footer Menu', 'twentynineteen' ),
				'social' => __( 'Social Links Menu', 'twentynineteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'twentynineteen' ),
					'shortName' => __( 'S', 'twentynineteen' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'twentynineteen' ),
					'shortName' => __( 'M', 'twentynineteen' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'twentynineteen' ),
					'shortName' => __( 'L', 'twentynineteen' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'twentynineteen' ),
					'shortName' => __( 'XL', 'twentynineteen' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'twentynineteen' ),
					'slug'  => 'primary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => __( 'Secondary', 'twentynineteen' ),
					'slug'  => 'secondary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'twentynineteen' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'twentynineteen' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'twentynineteen' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'twentynineteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function twentynineteen_scripts() {

	/* Custom Styles and Script */
	wp_enqueue_style( 'google-fonts' , 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), 1.0 );
	wp_enqueue_style( 'bootstrap-css'  , get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), 1.0 );
    wp_enqueue_style( 'styles-css'     , get_stylesheet_directory_uri() . '/css/style.css', array(), 1.0 );
	
	wp_enqueue_script( 'bootstrap-js'  , get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), 1.0 , false);
    wp_enqueue_script( 'main-js'       , get_template_directory_uri() . '/js/main.js', array('jquery'), 1.0 , false);
    global $wp_query;
    wp_localize_script( 'main-js', 'commentForm', 
                        array( 'comment_url' => admin_url( 'admin-ajax.php' ) ,
                               'query_vars' => json_encode($wp_query -> $query)) 
					   );
					   
	/* . Custom Styles and Script *
	wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.1', true );
		wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.1', true );
	}

	wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );
	*/
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );


/* Enqueing Custom Scripts */
add_action('wp_enqueue_scripts', 'treadly_reviews_scripts');
add_action('wp_enqueue_scripts', 'treadly_reviews_styles');

add_action( 'wp_ajax_insertComment', 'insertComment' );
add_action( 'wp_ajax_nopriv_insertComment', 'insertComment' );

add_action( 'wp_ajax_updateLikes', 'updateLikes');
add_action( 'wp_ajax_nopriv_updateLikes', 'updateLikes' );

add_action( 'wp_ajax_searchReview', 'searchReview');
add_action( 'wp_ajax_nopriv_searchReview', 'searchReview' );


/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function twentynineteen_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo twentynineteen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/* Customised Supports and Script */

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
/*
|--------------------
| Searching Review 
|--------------------
*/
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

/*
|-------------------------
|  Updating Custom Fields
|-------------------------
*/
function updateCustomField($field , $increment = true) {
    $field = get_field_object($field , $_POST['post_id']);    
    $count = (int) $field['value'];    
    $count = $increment ? ($count + 1 ) : ($count - 1);
    $response = update_field($field['key'], $count, $_POST['post_id']);
    return $response;
}

/*
|----------------------
|  Updating Post Meta
|----------------------
*/
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
/*
|--------------------
|  Updating Likes
|--------------------
*/
function updateLikes() {
    
    updatePostMeta($_POST['field']);
    $response = updateCustomField($_POST['field'] , true);
    
    echo json_encode(array('response' => $response, 
                           'likes'=> get_field('review_likes', $_POST['post_id']) , 
                           'dislikes' => get_field('review_dislikes', $_POST['post_id'])));
    exit();
}