<!Doctype htm>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Treadly</title>    
    <?php wp_head(); ?>  
    <meta name="viewport" content="width=device-width, initial-scale=1">         
</head>

<header>

    <!-- Navigation Menu Start --
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top mt-4">
        <div class="container">
            <a class="navbar-brand" href="#">
            <?/*php
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                if ( has_custom_logo() ) {
                    echo '<img src="'. esc_url( $logo[0] ) .'">';
                } else {
                    echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
                }
            */?>  
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    -- Navigation Menu Ends  -->

    <div class="row w-100 h-100 align-items-center">
        <div class="col-sm text-center">
            <?php if(get_background_image()) :  ?>
             <img class="bg" src="<?php background_image(); ?>" alt="<?php bloginfo('name'); ?>"/> 
            <?php endif;?>
            <?php if(is_home()) : ?>
            <div class="row buttons-wrapper mb-2">                
                <div class="col-sm">
                    <span class="header-text">
                        Real Bike Reviews From Real People
                    </span>
                </div>
                <div class="w-100"></div>

                <div class="col-sm">
                    <div class="row align-items-center">
                        <a class="col-sm btn header-btn mr-2 mb-2" href="#reviewForm" role="button">
                            <i class="fa fa-pencil pull-left"></i>Review your bike
                        </a>
                        <a class="col-sm btn header-btn ml-2 mb-2" href="#posts" role="button">
                            <i class="fa fa-flask pull-left"></i> <span>Find review</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</header>
    
<body>



