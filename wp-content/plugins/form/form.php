<?php 
    /*
    Plugin Name: Review Form
    Plugin URI : http://localhost:80/TreadlyReviews/
    Description: This plugin will be used to provide review form.
    Author     : Jawad Aziz Farhad
    Author URI : 
    Text-Domain: Review Form
    DomainPath : /languages
    Version    : 1.0
    */

    add_action('wp_enqueue_scripts','plugin_scripts');

    add_action( 'wp_ajax_submitReviewForm', 'submitReviewForm' );
    add_action( 'wp_ajax_nopriv_submitReviewForm', 'submitReviewForm' );

    add_action( 'wp_ajax_updateFileField', 'updateFileField' );
    add_action( 'wp_ajax_nopriv_updateFileField', 'updateFileField' );

    function plugin_scripts() {

        wp_enqueue_style('jquery-steps-css',  plugins_url( '/css/jquery.steps.css', __FILE__ ), array(), 1.0);
        wp_enqueue_style('loader-css',  plugins_url( '/css/loader.css', __FILE__ ), array(), 1.0);
        
        wp_enqueue_script( 'jquery', '/js/jquery-3.3.1.min.js', array(), 1.0, false );      
        wp_enqueue_script( 'jquery-steps', plugins_url( '/js/jquery.steps.js', __FILE__ ), array('jquery'), 1.0, false);          
        wp_enqueue_script( 'jquery-validate', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js', array('jquery'), 1.0, false );
        wp_enqueue_script( 'main', plugins_url( '/js/main.js', __FILE__ ), array('jquery'), 1.0, false);
        
        global $wp_query;
        wp_localize_script( 'main', 'reviewForm', 
                        array( 'review_url' => admin_url( 'admin-ajax.php' ) ,
                               'query_vars' => json_encode($wp_query -> $query)) 
                       );
    }

    function submitReviewForm() {

        $post = createPost();
        
        if($post['success'] === false)
            handleError($post);
        else{            
            $fields = acf_get_fields_by_id($post->post_id);
            
            $allFields = array();

            foreach ($fields as $field) {
                $value = $_POST[$field['name']];
                if(isset( $value )) {
                    if($field['key'] === 'category' || $field['key'] === 'country')
                        $value = array($value);
                    update_field($field['key'], $value , $post['post_id']);                      
                }            
                $fieldData = array( $field['key'] => $value , 'name' => $field['name']);
                array_push($allFields , $fieldData);
            }           

            $files = uploadFiles($post);
            echo json_encode(['files' => $files, 'post' => $post , 'all' => $allFields]);
            wp_die();
        }       
    }

    function handleError($error){
        echo json_encode($error);
        wp_die();
    }

    function createPost() {

        $data = $_POST;

        // Set the post ID to -1. This sets to no action at moment
        $post_id = -1;     
        // Set the Author, Slug, title and content of the new post
        $author_id = 1;
        $slug = makeSlug($data['brand'] . ' ' . $data['model']);
        $title = ' Review at ' . current_time( 'mysql' )  ;
        $content = '';

        // Cheks if doen't exists a post with slug "wordpress-post-created-with-code".
        $response = array();
        if( !post_exists_by_slug( $slug ) ) {
            $post = array(
                'comment_status'    =>   'open',
                'ping_status'       =>   'open',
                'post_author'       =>   $author_id,
                'post_name'         =>   $slug,
                'post_title'        =>   $title,
                'post_content'      =>   $content,
                'post_status'       =>   'draft',
                'post_type'         =>   'post'
            );            
            // Set the post ID
            $post_id = wp_insert_post( $post );

            if(!is_wp_error($post_id)){
                //the post is valid
                $response = ['post_id' => $post_id , 'success' => true];
                }else{
                    //there was an error in the post insertion, 
                    $response = ['message' => $post_id -> get_error_message() , 'success' => false];
                }
        } else {     
            // Set pos_id to -2 becouse there is a post with this slug.
            $post_id = -2;
            $response = ['post_id' => $post_id , 'success' => false, 'slug' => 'Slug already exist.'];         
        } // end if     
        
        return $response;
    } 

    function makeSlug($string) {
        //Lower case everything
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string . current_time( 'timestamp', 1 );
    }    

    function post_exists_by_slug( $post_slug ) {
        $args_posts = array(
            'post_type'      => 'post',
            'post_status'    => 'any',
            'name'           => $post_slug,
            'posts_per_page' => 1,
        );
        $loop_posts = new WP_Query( $args_posts );
        if ( ! $loop_posts->have_posts() ) {
            return false;
        } else {
            $loop_posts->the_post();
            return $loop_posts->post->ID;
        }
    }

    function uploadFiles($post = '') {
        $files = ['bike', 'gears', 'tyres' , 'handlebar' , 'suspension' , 'review_video'];
        $filesResponse = array();
        foreach($files as $file) {
            if(isset($_FILES[$file]) && !empty($_FILES[$file])){                
                $filesResponse[$file] = uploadFile($file , $post->post_id);
                $key = ( $file === 'review_video' ) ? $file : ($file . '_image');
                update_field($key, $filesResponse[$file]['response']['attachment_id'], $post['post_id']);
            }
        }

        return $filesResponse;
    }

    function uploadFile($name, $post_id){
        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }        
        $uploadedfile = $_FILES[$name];        
        $upload_overrides = array( 'test_form' => false );
        
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
        
        if ( $movefile && ! isset( $movefile['error'] ) ) {
            $response['message']  = $name . ' file is successfully uploaded.';
            $response['error']    = false;
            $movefile['attachment_id'] = insertAttachment($post_id , $movefile['url']);
            $response['response'] = $movefile;
        } else {
            $response['message'] = $movefile['error'];
            $response['error']   = false;
        }

        return $response;
    }


    function insertAttachment($postid, $filename){
        
        // Check the type of file. We'll use this as the 'post_mime_type'.
        $filetype = wp_check_filetype( basename( $filename ), null );

        // Get the path to the upload directory.
        $wp_upload_dir = wp_upload_dir();

        // Prepare an array of post data for the attachment.
        $attachment = array(
            'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
            'post_mime_type' => $filetype['type'],
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
            'post_content'   => '',
            'post_status'    => 'inherit',
            'post_parent'    => $postid
        );

        // Insert the attachment.
        $attach_id = wp_insert_attachment( $attachment, $filename, $postid );

        // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
	    require_once( ABSPATH . 'wp-admin/includes/media.php' );

        // Generate the metadata for the attachment, and update the database record.
        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
        wp_update_attachment_metadata( $attach_id, $attach_data );

        return $attach_id;
    }

/*-------------- */
function show_Form($data = [])
{
  include('templates/form.html');
}

function process_Form($data)
{
  include('templates/form.html');
}

function validate_Form($data)
{
  $data['errors'] = array();
  if (strlen($data['name']) < 10) {
    $data['errors']['name'] = 'Name is too short';
    $data['errors']['class']= 'is-invalid';
  }

  return $data;
}

function sampleForm()
{
  $data = isset($_POST['data']) ? $_POST['data'] : false;
  if ($data) {
    //$data = validateForm($data);
    $data = checkValues($data);
    if (!empty($data['errors'])) {
        show_Form($data);
    }
    else {
        process_Form($data);
    }
  }
  else {
    show_Form(array([]));
  }

}
add_shortcode( 'review_form', 'sampleForm' );
?>