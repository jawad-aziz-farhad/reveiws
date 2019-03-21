<?php get_header(); ?>
<div class="wrapper">
    <div class="container">

        <div class="row">
            <div class="col-3">
                <div class="row">

                 <form id="searchForm" method="post">

                    <div class="col-sm">
                        <label for="bikeBrand" class="float-left">Bike Brand</label>
                        <input type="text" class="form-control is-invalid" id="bikeBrand" name="brand" placeholder="Enter bike brand" value="" required>
                    </div>

                    <div class="w-100"></div>
                    
                    <div class="col-sm mt-2">
                        <label for="model"  class="float-left">Bike Model</label>
                        <input type="text" class="form-control is-invalid" id="model" name="model" placeholder="Enter bike model" value="" required>
                    </div>
                    
                    <div class="w-100"></div>
                    
                    <div class="col-sm mt-2">
                        <label for="category" class="float-left">Bike Category</label>
                        <input type="text" class="form-control is-invalid" id="category" name="category" placeholder="Enter bike category" value="" required>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-sm mt-2">
                        <label for="minPrice" class="float-left">Price (Min)</label>
                        <input type="text" class="form-control is-invalid" id="minPrice" name="minPrice" placeholder="Enter min price" value="" required>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-sm mt-2">
                        <label for="maxPrice" class="float-left">Price (Max)</label>
                        <input type="number" class="form-control is-invalid" id="maxPrice" name="maxPrice" placeholder="Enter max price" value="" required>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-sm mt-2">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>

                 </form>

                </div>
            </div>
        
            <div class="col-9">
                
              <div class="owl-carousel">	
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <div class="item">
                    
                    <div class="cardbox shadow-lg bg-white">
                        
                        <div class="cardbox-heading">
                        
                        <?php
                            $author_id = get_post_field( 'post_author', get_the_ID() );
                            $author_name  = get_the_author_meta('user_nicename', $author_id);
                            $author_email = get_the_author_meta('user_email', $author_id);
                        ?>

                        <div class="media m-0">
                        <?php  $image = get_field('gears_image'); if ($image):?>
                        <div class="d-flex mr-3">
                          <a href=""><?php echo get_avatar( get_the_author_meta( 'ID' ), get_the_ID() ); ?></a>
                        </div>
                        <?php endif;?>
                        <div class="media-body">
                        <p class="m-0"><?php echo ((strlen(get_the_title()) < 27) ? get_the_title() : substr(get_the_title(), 0, 24).'..'); ?></p>
                        <?php
                            
                            if( $author_name ):
                        ?>
                        <small><span><i class="icon ion-md-pin"></i> <?php echo $author_name; ?></span></small>

                        <?php endif;?>
                        <small><span><i class="icon ion-md-time"></i> <?php the_time('F j, Y g:i A') ?></span></small>
                        </div>
                        </div><!--/ media -->
                        </div><!--/ cardbox-heading -->
                        
                        <div class="cardbox-item">
                            <?php 
                            $image = get_field('gears_image');
                            if( !empty($image) ): ?>
                            <img class="img-fluid" src="<?php echo $image['url']; ?>" alt="<?php echo get_the_title(); ?>" />
                            <?php else: ?>
                            <img class="img-fluid" src="http://placehold.it/900x300" alt=""> 
                            <?php endif; ?>
                        
                        </div><!--/ cardbox-item -->

                        <div class="cardbox-base"> 

                            <ul class="float-right">
                                
                                <li><a><i class="fa fa-comments"></i></a></li>
                                <?php $comments_count = wp_count_comments( get_the_ID() ); ?>
                                <li><a><em class="mr-5"><?php echo $comments_count->approved; ?></em></a></li>
                                
                                <li><a><i class="fa fa-share-alt"></i></a></li>
                                <li><a><span>242 Likes</span></a></li>
                            </ul>

                            	   
                        </div><!--/ cardbox-base -->

                          
                            
                        </div><!--/ cardbox -->

                    </div><!--/ col-lg-6 -->

                    <?php endwhile; else: ?>
                        <p><?php _e('Sorry, this page does not exist.'); ?></p>
                    <?php endif; ?>

                </div><!--/ row -->
            </div>
          </div>
        </div>
    </div> 
<?php
    echo do_shortcode("[sc_sample_form]"); ?>
<?php
    get_footer(); 
?>