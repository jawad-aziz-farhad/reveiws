<?php get_header(); ?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-sm">

        <!-- Title -->
        <h1 class="mt-4"><?php the_title(); ?></h1>
        <?php 
        $author_id = get_post_field( 'post_author', get_the_ID() );
        $author_name  = get_the_author_meta('user_nicename', $author_id);
        $author_email = get_the_author_meta('user_email', $author_id);
        if( $author_name ):
        ?>
        <!-- Author -->
        <p class="lead">
          by
          <a href="#"><?php echo $author_name; ?></a>
        </p>

        <?php endif; ?>

        <hr>

        <!-- Date/Time -->
        <p>Posted on <?php the_time('F j, Y g:i A') ?></p>

        <hr>

        <!-- Preview Image -->
        <div class="text-center">  
        <?php 
        $image = get_field('gears_image');
        if( !empty($image) ): ?>
        <img class="img-fluid rounded" src="<?php echo $image['url']; ?>" alt="<?php echo get_the_title(); ?>" />
        <?php else: ?>
        <img class="img-fluid rounded" src="http://placehold.it/900x300" alt=""> 
        <?php endif; ?>
        </div>

        <hr>

        <!-- Post Content -->

        <div class="col-sm">

          <!-- Brand and Model -->
          <div class="row"> 

            <div class="col-sm">
              <label for="bikeBrand" class="float-left">Bike Brand</label>
              <input type="text" class="form-control" id="bikeBrand" name="brand" value="<?php echo get_field('brand'); ?>" disabled>
            </div>

            <div class="col-sm">
              <label for="bikeModel" class="float-left">Bike Model</label>
              <input type="text" class="form-control" id="bikeModel" name="model" value="<?php echo get_field('model'); ?>" disabled>
            </div>

          </div>

          <!-- Category and Price -->
          <div class="row mt-2"> 

            <div class="col-sm">
              <label for="bikeCategory" class="float-left">Bike Category</label>
              <input type="text" class="form-control" id="bikeCategory" name="category" value="<?php echo get_field('category'); ?>" disabled>
            </div>

            <div class="col-sm">
              <label for="bikeprice" class="float-left">Bike Price</label>
              <input type="text" class="form-control" id="bikeprice" name="price" value="<?php echo get_field('price'); ?>" disabled>
            </div>

          </div>
          <!-- Category and Price ends-->

          <!-- Bike Liking/ Disliking Starts -->
          <div class="row w-100 mt-2">
              <div class="col-sm mb-0">
                <label for="like_level">Like Level: <?php echo get_field('like_level');?></label>                
              </div>
              <div class="w-100">
              <div class="col-sm">       
                <input type="range" class="w-100" name="right_wrong" id="like_level" min="1" max="10" value="<?php echo get_field('like_level');?>" disabled>
              </div>
          </div>
          <!-- Bike Liking/ Disliking ends -->

          <!-- Feedbacks -->
          <div class="row w-100 mt-2">
            <!-- Positive -->
            <div class="col-sm">
              <ul class="list-group list-group-flush">
                <?php for( $i = 1; $i < 4; $i++ ) { 
                  $index = $i == 1 ? '1st' : ($i == 2 ? '2nd' : '3rd');
                  ?>      
                  <li class="list-group-item list-group-item-success"><?php echo get_field($index .'_positive_feedback'); ?></li>                
                <?php }; ?>
              </ul>
            </div>
            <!-- .Positive -->

            <!-- Negative -->
            <div class="col-sm">
              <ul class="list-group list-group-flush">
                <?php for( $i = 1; $i < 4; $i++ ) { 
                  $index = $i == 1 ? '1st' : ($i == 2 ? '2nd' : '3rd');
                  ?>      
                  <li class="list-group-item list-group-item-danger"><?php echo get_field($index .'_negative_feedback'); ?></li>                
                <?php }; ?>
              </ul>
            </div>
            <!-- .Negative -->

          </div>

          <div class="w-100"></div>

          <!-- Ratings Starts-->
          <div class="col-sm">

            <div class="row w-100 mt-3 pl-2">
              <div class="col-sm">
                  <legend for="customRange1">Ratings:</legend>                
              </div>            
            </div>
       

          <!-- Money, Frame, Comfor  row starts -->
          <div class="row w-100">

            <div class="col-sm">
                <div class="row ">
                    
                    <div class="col-sm text-center">
                        <label for="positiveFeedback3">Value for money:</label>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">                      
                      <?php 
                        $rating = get_field('money_rating');
                        for( $i = 1; $i < 6; $i++ ) { 
                          if($i <= $rating)
                           echo  '<input type="radio" id="frame_star5" name="frame_rating" value="'. $i .'" /><label style="color: #FF912C;" for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                          else
                           echo  '<input type="radio" id="frame_star5" name="frame_rating" value="'. $i .'" /><label style="color: #CC; for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';

                        }?> 
                    </div>
                </div>
            </div>

            <div class="col-sm">
                <div class="row">
                    
                    <div class="col-sm text-center">
                        <label for="positiveFeedback3">Frame:</label>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                      <?php 
                        $rating = get_field('frame_rating');
                        for( $i = 1; $i < 6; $i++ ) { 
                          if($i <= $rating)
                           echo  '<input type="radio" id="frame_star5" name="frame_rating" value="'. $i .'" /><label style="color: #FF912C;" for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                          else
                           echo  '<input type="radio" id="frame_star5" name="frame_rating" value="'. $i .'" /><label style="color: #CC; for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';

                      }?> 
                    </div>
                </div>
            </div>

            <div class="col-sm">
                <div class="row">
                    
                    <div class="col-sm text-center">
                        <label for="positiveFeedback3">Comfort:</label>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                      <?php 
                        $rating = get_field('comfort_rating');
                        for( $i = 1; $i < 6; $i++ ) { 
                          if($i <= $rating)
                           echo  '<input type="radio" id="comfort_star5" name="comfort_rating" value="'. $i .'" /><label style="color: #FF912C;" for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                          else
                           echo  '<input type="radio" id="comfort_star5" name="comfort_rating" value="'. $i .'" /><label style="color: #CC; for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';

                      }?> 
                    </div>
                </div>
            </div>
        </div>
        <!-- Money, Frame, Comfor Rating row ends -->

      <!-- Design Gears & Steering  row starts -->
      <div class="row w-100 mt-2">

            <div class="col-sm">
                <div class="row ">
                    
                    <div class="col-sm text-center">
                        <label for="positiveFeedback3">Design:</label>
                    </div>
    
                    <div class="w-100"></div>
    
                    <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                      <?php 
                        $rating = get_field('design_rating');
                        for( $i = 1; $i < 6; $i++ ) { 
                          if($i <= $rating)
                           echo  '<input type="radio" id="design_star5" name="design_rating" value="'. $i .'" /><label style="color: #FF912C;" for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                          else
                           echo  '<input type="radio" id="design_star5" name="design_rating" value="'. $i .'" /><label style="color: #CC; for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                      }?> 
                    </div>
                </div>
            </div>
    
            <div class="col-sm">
                <div class="row">
                    
                    <div class="col-sm text-center">
                        <label for="positiveFeedback3">Gears:</label>
                    </div>
    
                    <div class="w-100"></div>
    
                    <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                      <?php 
                        $rating = get_field('gears_rating');
                        for( $i = 1; $i < 6; $i++ ) { 
                          if($i <= $rating)
                           echo  '<input type="radio" id="gears_star5" name="gears_rating" value="'. $i .'" /><label style="color: #FF912C;" for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                          else
                           echo  '<input type="radio" id="gears_star5" name="gears_rating" value="'. $i .'" /><label style="color: #CC; for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                      }?> 
                    </div>
                </div>
            </div>
    
            <div class="col-sm">
                <div class="row">
                    
                    <div class="col-sm text-center">
                        <label for="positiveFeedback3">Steering:</label>
                    </div>
    
                    <div class="w-100"></div>
    
                    <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                    <?php 
                        $rating = get_field('steering_rating');
                        for( $i = 1; $i < 6; $i++ ) { 
                          if($i <= $rating)
                           echo  '<input type="radio" id="steering_star5" name="steering_rating" value="'. $i .'" /><label style="color: #FF912C;" for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                          else
                           echo  '<input type="radio" id="steering_star5" name="steering_rating" value="'. $i .'" /><label style="color: #CC; for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                      }?> 
                    </div>
                </div>
            </div>
    </div>
    <!-- Design Gears & Steering row ends -->

    <!-- Wheels  & Saddle row starts -->
    <div class="row w-100 mt-2">

        <div class="col-sm">
            <div class="row ">
                
                <div class="col-sm text-center">
                    <label for="positiveFeedback3">Wheels:</label>
                </div>

                <div class="w-100"></div>

                <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                  <?php 
                    $rating = get_field('wheels_rating');
                    for( $i = 1; $i < 6; $i++ ) { 
                      if($i <= $rating)
                        echo  '<input type="radio" id="wheels_star5" name="wheels_rating" value="'. $i .'" disabled/><label style="color: #FF912C;" for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                      else
                        echo  '<input type="radio" id="wheels_star5" name="wheels_rating" value="'. $i .'" disabled/><label style="color: #CC; for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                  }?> 
                </div>
            </div>
        </div>

        <div class="col-sm">
            <div class="row">
                
                <div class="col-sm text-center">
                    <label for="positiveFeedback3">Saddle:</label>
                </div>

                <div class="w-100"></div>

                <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
                <?php 
                    $rating = get_field('saddle_rating');
                    for( $i = 1; $i < 6; $i++ ) { 
                      if($i <= $rating)
                        echo  '<input type="radio" id="saddle_star5" name="saddle_rating" value="'. $i .'" /><label style="color: #FF912C;" for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                      else
                        echo  '<input type="radio" id="saddle_star5" name="saddle_rating" value="'. $i .'" /><label style="color: #CC; for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
                  }?> 
                </div>
            </div>
        </div>

     
    </div>
    <!-- Wheels & Saddle row ends -->
   
    </div>
    <!-- ./Ratings ends -->
    
    <div class="w-100"></div>
                
    
    <div class="col-sm">

      <div class="row w-100 mt-3 pl-2">
        <div class="col-sm">
          <legend for="customRange1">Likes / Dislikes:</legend>                
        </div>            
      </div>
               
      <hr>

      <div class="row">
        
        <!-- Like Starts -->          
        <div class="col-sm text-center">

          <button class="btn btn-lg btn-success btn-twitter btn-sm like_dislike_Btns" id="like_Btn" post_id="<?php echo get_the_ID(); ?>" field="review_likes">
            <i class="fa fa-thumbs-up"></i>
            <?php echo get_field('review_likes', get_the_ID()) ; ?> Likes 
          </button>

          <button class="btn btn-lg btn-danger btn-twitter btn-sm like_dislike_Btns" id="dislike_Btn" post_id="<?php echo get_the_ID(); ?>" field="review_dislikes">
            <i class="fa fa-thumbs-down"></i>
            <?php echo get_field('review_dislikes', get_the_ID() ) ?> Dislikes
          </button>
          
        </div>
        <!-- Like Ends -->

        <!-- Share Starts -->
        <div class="col-sm text-center">          
          <?php
            echo do_shortcode("[wp_social_sharing social_options='facebook,twitter,linkedin,pinterest' twitter_username='' facebook_text='facebook' twitter_text='twitter' linkedin_text='linkedin' pinterest_text='pinterest' xing_text='Share on Xing' reddit_text='Share on Reddit' icon_order='f,t,l,p,x,r' show_icons='0' before_button_text='' text_position='' social_image='']");
          ?>
        </div>
        <!-- Share Ends -->
        
      </div>

    </div>
    

  </div>

    <hr>

    <!-- Comments Form -->
    <div class="card my-4">
      <h5 class="card-header">Leave a Comment:</h5>
      <div class="card-body">
      <form id="commentForm" role="form" method="post">
      <div class="form-group">
        <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>
      </div>
      <input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>"/>
      <input type="hidden" name="author_name" value="<?php echo $author_name; ?>"/>
      <input type="hidden" name="author_email" value="<?php echo (int)$author_email; ?>"/>

      <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      
      </div>
    </div>

    <!-- Single Comment -->

    <?php $comments = get_comments(); 
        foreach ($comments as $comment) {                
    ?>

    
    <div class="media mb-4">
      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
      <div class="media-body">
        <h5 class="mt-0"><?php echo $comment->comment_author; ?></h5>
        <?php echo $comment->comment_content ?>
      </div>
    </div>

    <?php } ?>


  </div>
  <!-- /.row -->

  </div>
  <!-- /.container -->

<?php get_footer(); ?>