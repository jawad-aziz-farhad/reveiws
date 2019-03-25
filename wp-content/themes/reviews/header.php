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
 
    <!-- Navbar Starts -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand" href="#"><?php esc_html_e( bloginfo( 'name' ), 'themeslug' ); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?php if(is_home()):?> active <?php endif;?>">
                    <a class="nav-link" href="<?php echo get_home_url(); ?>">Home</a>
                </li>
                <li class="nav-item <?php if($pagename == 'about'):?> active <?php endif;?>"">
                    <a class="nav-link" href="http://localhost:8888/treadly_reviews/about">About</a>
                </li>
                <li class="nav-item<?php if($pagename == 'subscribe'):?> active <?php endif;?>"">
                    <a class="nav-link" href="http://localhost:8888/treadly_reviews/subscribe">Subscribe</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Navbar Ends -->

    <div class="row w-100 m-0">
        <div class="col-sm w-100 p-0">
            <?php if(get_background_image() && !is_singular( 'post' ) ) :  ?>
             <img class="bg" src="<?php background_image(); ?>" alt="<?php bloginfo('name'); ?>"/> 
            <?php endif;?>
            <?php if(is_home() || $pagename === 'home') : ?>
            <div class="row buttons-wrapper mb-2">                
                <div class="col-sm text-center">
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



