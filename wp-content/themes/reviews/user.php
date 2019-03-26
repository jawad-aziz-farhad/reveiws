<?php /* Template Name: User */ 
    get_header();

    $display_name = um_user('display_name');
    echo $display_name; // prints the user's display name
?>