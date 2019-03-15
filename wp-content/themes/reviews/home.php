<?php get_header(); 
    //get_template_part('review-form'); 
    //echo do_shortcode("[review-form]");
?>
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
                    <a href="<?php the_permalink(); ?>">
                        <div class="item">
                            <div class="top product">

                                <hr>
                                <div class="prod-name"> 
                                    <span>
                                        <?php  echo ((strlen(get_the_title()) < 27) ? get_the_title() : substr(get_the_title(), 0, 24).'..'); ?>
                                    </span>
                                </div> 

                                <hr>

                                <div class="prod-img"> 
                                    <?php 
                                        $image = get_field('gears_image');

                                    if( !empty($image) ): ?>

                                    <img src="<?php echo $image['url']; ?>" alt="<?php echo get_the_title(); ?>" />

                                    <?php endif; ?>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-sm">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </a><!-- .a -->
                

                <?php endwhile; else: ?>
                    <p><?php _e('Sorry, this page does not exist.'); ?></p>
                <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div> 
<?php
    echo do_shortcode("[sc_sample_form]"); ?>
<?php
    get_footer(); 
?>