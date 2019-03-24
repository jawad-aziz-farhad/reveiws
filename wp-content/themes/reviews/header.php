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
    <!-- Navigation Menu Starts  -->
    <div id="main_navbar" class="navbar navbar-expand-md navbar-light bg-light">
    <!-- you can remove this container wrapper if you want things full width -->
    <div class="container">
        <a class="navbar-brand" href="#"><?php esc_html_e( bloginfo( 'name' ), 'themeslug' ); ?></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerNav" aria-controls="headerNav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'best-reloaded' ); ?>">
            <span class="navbar-toggler-icon"></span><span class="sr-only"><?php esc_html_e( 'Toggle Navigation', 'themeslug' ); ?></span>
        </button>
        <nav class="collapse navbar-collapse" id="headerNav" role="navigation" aria-label="Main Menu">
            <span class="sr-only"><?php esc_html_e( 'Main Menu', 'themeslug' ); ?></span>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'depth' => 2,
                'container' => false,
                'menu_class' => 'navbar-nav mr-auto',
                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                'walker' => new WP_Bootstrap_Navwalker(),
            ) );
        ?>
        </nav>
    </div>
</div>
    <!-- Navigation Menu Ends  -->

    <div class="row w-100 m-0">
        <div class="col-sm w-100 p-0">
            <?php if(get_background_image()) :  ?>
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



