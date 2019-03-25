<?php /* Template Name: Home */  
    get_header(); 
?>
<div class="wrapper">    
    <div class="container">
        <div class="row mt-4" id="posts">                
            <div class="col-sm mb-2">
                <form id="searchForm">    
                    <div class="row">

                        <div class="col-sm">
                            <div class="form-group">
                                <input id="brand" name="brand" type="text" class="form-control" placeholder="Enter brand" value="">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <input id="model" name="model" type="text" class="form-control" placeholder="Enter model" value="">
                            </div>
                        </div>

                        <div class="w-100"></div>

                        <div class="col-sm">
                            <div class="form-group">
                                <?php

                                    $categories = array("Round Bike", "Mountain Bike" , "Cruiser", "Hybrid/Comfort Bike" , "Triathlon/Time Trial Bike",
                                                        "BMX/Trick Bike", "Commuting Bike" , "Cyclocross Bike", "Track Bike / Fixed Gear", "Tandem",
                                                        "Folding Bike", "Kids Bike", "Recumbent", "I'm not sure, help me!");
                                    $options = '<option value="">select category</option>'; 
                                    $index = 0;
                                    foreach($categories as $_category){
                                        $selected = ($index === 0) ? 'selected' : '';
                                        $options .= '<option value="' . $_category . '" $selected>' . $_category . '</option>';
                                        $index++;
                                    }
                                    ?>

                                    <select class="form-control" id="category" name="category"> <?php echo $options ?> </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <input id="price_min" name="price_min" type="number" class="form-control" placeholder="Enter price (min)" value="">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <input id="price_max" name="price_max" type="number" class="form-control" placeholder="Enter price (max)" value="">
                            </div>
                        </div>

                        <div class="w-100"></div>

                        <div class="col-sm">
                            <button id="search_btn" class="btn btn-success btn-block"> Search </button>
                        </div>

                    </div>

                </form>

            </div>
           
        </div>
        <!-- .row -->  
        <div class="w-100"></div>
            
        <div class="row" id="reviews">    
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <a href="<?php the_permalink(); ?>" >
                            <div class="card">

                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-sm">
                                            <img class="img-fluid float-left rounded-circle" width="40"  height="40" src="https://image.shutterstock.com/image-vector/avatar-man-icon-profile-placeholder-260nw-1229859850.jpg" alt="">
                                            <?php
                                                $author_id = get_post_field( 'post_author', get_the_ID() );
                                                $author_name  = get_the_author_meta('user_nicename', $author_id);
                                            ?>
                                            <label class="text-muted m-2"><?php echo get_field('name'); ?> </label>
                                        </div>
                                    </div>
                                </div>

                                <?php $video = get_field('review_video');?>
                                <video class="img-fluid card-img-top" id="videoTag" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop" controls="controls">
                                    <source src="<?php echo $video['url']; ?>" type="video/mp4">
                                </video>

                                <div class="card-body">
                                    <div class="row w-100 mt-2">
                                        <div class="col-6">
                                            <div class="card border-sdark mx-sm-1 p-3 text-center">
                                                <div class="card border-sdark shadow text-dark p-1 my-card" ><span class="fa fa-bicycle" aria-hidden="true"></span></div>
                                                <div class="text-dark text-center mt-3"><h4>Brand</h4></div>
                                                <small class="text-muted text-center"><?php echo get_field('brand');?></small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card border-sdark mx-sm-1 p-3">
                                                <div class="card border-sdark shadow text-dark p-1 my-card" ><span class="fa fa-bicycle" aria-hidden="true"></span></div>
                                                <div class="text-dark text-center mt-3"><h4>Model</h4></div>
                                                <small class="text-muted text-center"><?php echo get_field('model');?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-muted">

                                
                                    <div class="float-right">
                                        <?php $comments_count = wp_count_comments( get_the_ID() ); ?>
                                        <small>
                                            <?php echo $comments_count->approved; ?>
                                            <i class="fa fa-comments"></i>                                            
                                        </small>        
                                        
                                        <small class="ml-1">
                                            <?php $likes = get_field('review_likes');
                                                 $likes  = $likes ? $likes : 0;
                                                 echo $likes;
                                            ?>

                                            <i class="fa fa-thumbs-up"></i>
                                        </small>
                                        
                                    </div>
                                </div>
                            </div>
                            <!--./ card -->
                        </a>
                        <!--./ a -->
                    </div>
                    <!--./ column -->

                <?php endwhile; else: ?>
                    <div class="col-sm text-center">
                        <div class="img-fluid"> <img src="<?php echo get_site_url() ?>/wp-content/themes/reviews/images/empty_product.svg" alt="No_Product"></div>
                    </div>
                    <hr>
                <?php endif; ?>
            </div>
            <!-- .row -->    
        </div>
         <!-- .container -->  
    </div> 
     <!-- .wrapper -->  
<?php
    echo do_shortcode("[review_form]"); ?>
<?php
    get_footer(); 
?>