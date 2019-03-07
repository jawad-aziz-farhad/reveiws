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
    function plugin_scripts() {
        wp_enqueue_script( 'jquery',      'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), 1.0, false );
        wp_enqueue_script( 'ava-test-js', plugins_url( '/js/form.js', __FILE__ ), array('jquery'), 1.0, false);
    }
    
    function showForm($data){
        include('templates/form1.html');
    }

    function processForm($data){
        include('templates/success-submission.html');
    }

    function checkValues($data){
        foreach( $data as $key => $val ) {
            if( is_array( $key ) ) {
                foreach( $key as $val) {
                    $data['errors'][$key] = validation($data, $key);
                }
            } else {
                $data['errors'][$key] = validation($data, $key);
            }
        }       
        return $data;
    }

    function validation($data, $key){
        $error = array();
        if (empty($data[$key])){
            $error['message'] = '<small class="invalid-feedback">' . $key . ' is required.</small>';
            $error['class']   = 'is-invalid';
        } 
        else {
            if($key === 'name' && !preg_match("/^[a-zA-Z ]*$/", $data[$key])){
               $error['message'] = "Only letters and white space allowed."; 
               $error['class']   = 'is-invalid';
            }
            else if($key === 'email' && !filter_var( $data[$key] , FILTER_VALIDATE_EMAIL)){
               $error['message'] = "Email is invalid."; 
               $error['class']   = 'is-invalid';
            }            
            else{
                $error['message'] = '';
                $error['class']   = 'is-valid';
            }
        }
        return $error;

    }
    function validateForm($data) {
        $data['errors'] = array();
        if (empty($_POST["name"])) {
            $data['errors']['name'] = "Name is required";
            $data['errors']['name']['class'] = 'is-invalid';
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
              $data['errors']['name'] = "Only letters and white space allowed"; 
            }

            else if (!strlen($_POST["name"] > 5))
             $data['errors']['name'] = "Name must have 5 characters.";

            $data['errors']['name']['class']= 'is-invalid'; 

        }
        if (empty($_POST["email"])) {
            $data['errors']['email'] = "Email is required";
            $data['errors']['email']['class']= 'is-invalid';
        }
        else if(!filter_var( $data['email'] , FILTER_VALIDATE_EMAIL)){
         $data['errors']['email'] = 'Invalid Email';
         $data['errors']['email']['class']= 'is-invalid';   
        }

        return $data;
    }
    function reviewForm(){
        $data = isset($_POST['data']) ? $_POST['data'] : false;
        if($data){
            $data = validateForm($data);
            if(!empty($data['errors']))
                showForm($data);
            else
                processForm($data);
        }
        else{
            $data = ['name' => ''];
            showForm($data);
        }
    }
    add_shortcode('review-form', 'showForm');


/*-------------- */
function show_Form($data = [])
{
  include('templates/form1.html');
}

function process_Form($data)
{
  include('templates/success-submission.html');
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
add_shortcode( 'sc_sample_form', 'sampleForm' );
?>