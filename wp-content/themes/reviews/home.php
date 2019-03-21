<?php get_header(); ?>
<div class="wrapper">    
    <div class="container">
        <div class="row">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    
                    <div class="col-lg-4 col-md-6 col-sm-1 mb-3">
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
                                            <label class="text-muted"><?php echo $author_name; ?> </label>
                                        </div>
                                    </div>
                                </div>

                                <?php $video = get_field('review_video');?>
                                <video class="img-fluid card-img-top" id="videoTag" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop" controls="controls">
                                    <source src="<?php echo $video['url']; ?>" type="video/mp4">
                                </video>

                                <div class="card-body">
                                   
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
                    <div class="col-sm">
                        <p><?php _e('Sorry, this page does not exist.'); ?></p>
                    </div>
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