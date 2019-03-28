<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

<!-- Page Content -->
<div class="container">

<div class="row">

  <!-- Author , Video column -->
  <div class="col-sm">        
	<?php 
	$author_id = get_post_field( 'post_author', get_the_ID() );
	$author_name  = get_the_author_meta('user_nicename', $author_id);
	$author_email = get_the_author_meta('user_email', $author_id);
	if( $author_name ): ?>
	<!-- Author -->
	<h6 class="mt-4 mb-0"><?php echo get_field('name'); ?></h6><hr>
	<h1><?php echo get_field('brand'); ?> - <?php echo get_field('model'); ?></h1>
	<?php endif; ?>

	<hr>

	<!-- Date/Time -->
	<p>Posted on <?php the_time('F j, Y g:i A') ?></p>

	<hr>

	<!-- Review video -->
	<div class="text-center">  
	  <?php $video = get_field('review_video');?>
	  <video class="img-fluid card-img-top" id="videoTag" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop" controls="controls">
		  <source src="<?php echo $video['url']; ?>" type="video/mp4">
	  </video>
	</div>

	<hr>

</div><!-- /.Author , Video column-->
	
<div class="w-100"></div>

<!-- Images Starts -->
<div class="col-sm">
  <div class="row w-100 p-3 align-self-center text-center">
	<?php $images = array('bike_image', 'tyres_image' , 'suspension_image' , 'handlebar_image' , 'gears_image' );
	  foreach($images as $image) {
	?>
	<?php if(!empty (get_field($image) )) : ?>
	<div class="col-sm mb-2">
	  <img class="img-fluid" width="200" height="200" src="<?php echo get_field($image)['url']?>" alt="<?php echo $image?>">
	</div>
	<?php endif;}?>
  </div>
</div> 
<!-- Images ends -->

<div class="w-100"></div>

<!-- Brand, Model , Price, Category column -->
<div class="col-sm">

  <!-- Brand and Model -->
  <div class="row"> 

	<div class="col-sm mb-1">
	  <label for="bikeBrand" class="float-left">Bike Brand</label>
	  <input type="text" class="form-control" id="bikeBrand" name="brand" value="<?php echo get_field('brand'); ?>" disabled>
	</div>

	<div class="col-sm mb-1">
	  <label for="bikeModel" class="float-left">Bike Model</label>
	  <input type="text" class="form-control" id="bikeModel" name="model" value="<?php echo get_field('model'); ?>" disabled>
	</div>

  </div>
  <!-- /. Brand and Model -->

  <!-- Category and Price -->
  <div class="row"> 

	<div class="col-sm mb-1">
	  <label for="bikeCategory" class="float-left">Bike Category</label>
	  <input type="text" class="form-control" id="bikeCategory" name="category" value="<?php echo get_field('category'); ?>" disabled>
	</div>

	<div class="col-sm mb-1">
	  <label for="bikeprice" class="float-left">Bike Price</label>
	  <input type="text" class="form-control" id="bikeprice" name="price" value="<?php echo get_field('price'); ?>" disabled>
	</div>

  </div>
  <!-- Category and Price ends-->

</div>
<!-- /.Brand, Model , Price, Category column -->

<div class="w-100"></div>

<!-- Bike Liking/ Disliking Starts -->
<div class="col-sm mb-1 mt-1">
  <label for="like_level">Like Level: <?php echo get_field('like_level');?></label>                
</div>

<div class="w-100"></div>

<div class="col-sm mb-1">
  <input type="range" class="w-100" name="right_wrong" id="like_level" min="1" max="10" value="<?php echo get_field('like_level');?>" disabled>
</div>
<!-- Bike Liking/ Disliking ends -->

<div class="w-100"></div>

<!-- /. Feedbacks starts -->
<div class="col-sm">
  <div class="row">
	<!-- Positive feedback -->
	<div class="col-sm">
	   <?php for( $i = 1; $i < 4; $i++ ) { $index = $i == 1 ? '1st' : ($i == 2 ? '2nd' : '3rd'); ?>
		  <div class="form-group">
		  <label for="comment"><?php echo $index .' Positive Feedback:'?></label>
			<textarea class="form-control text-sm-left" rows="4" id="<?php echo 'positive_'. $i ?>"  disabled><?php echo get_field($index .'_positive_feedback'); ?></textarea>
		  </div>            
	  <?php }; ?>       
	</div>
	<!-- /. Positive feedback -->
	  
	<!-- Negative feedback -->  
	<div class="col-sm">
	  <?php for( $i = 1; $i < 4; $i++ ) { $index = $i == 1 ? '1st' : ($i == 2 ? '2nd' : '3rd'); ?>
		  <div class="form-group">
			<label for="comment"><?php echo $index .' Negative Feedback:'?></label>
			<textarea class="form-control text-sm-left" rows="4" id="<?php echo 'negative_'. $i ?>" disabled><?php echo get_field($index .'_negative_feedback'); ?></textarea>
		  </div>            
		  <?php }; ?>     
	  </div>
	<!-- /. Negative feedback -->
  </div>
</div>
<!-- /. Feedbacks ends -->

<div class="w-100"></div>

<div class="col-sm">
  <legend for="customRange1">Ratings:</legend>                
</div>

<div class="w-100"></div>  

<!-- Money, Frame, Comfor  row starts -->
<div class="col-sm">

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
			for( $i = 5; $i >= 1; $i-- ) { 
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
		  for( $i = 5; $i >= 1; $i-- ) { 
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
			  for($i = 5; $i >= 1; $i-- ) { 
				if($i <= $rating)
				echo  '<input type="radio" id="comfort_star5" name="comfort_rating" value="'. $i .'" /><label style="color: #FF912C;" for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
				else
				echo  '<input type="radio" id="comfort_star5" name="comfort_rating" value="'. $i .'" /><label style="color: #CC; for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
			}?> 
		  </div>
	  </div>
	</div>
  </div>

</div>
<!--/. Money, Frame, Comfor Rating row ends -->

<div class="w-100"></div>

<!-- Design Gears & Steering  row starts -->            
<div class="col-sm">        
  <div class="row w-100">
	<div class="col-sm">
	  <div class="row ">
		  
		  <div class="col-sm text-center">
			  <label for="positiveFeedback3">Design:</label>
		  </div>

		  <div class="w-100"></div>

		  <div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
			<?php 
			  $rating = get_field('design_rating');
			  for($i = 5; $i >= 1; $i-- ) { 
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
				for($i = 5; $i >= 1; $i-- ) { 
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
				for($i = 5; $i >= 1; $i-- ) { 
				  if($i <= $rating)
				  echo  '<input type="radio" id="steering_star5" name="steering_rating" value="'. $i .'" /><label style="color: #FF912C;" for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
				  else
				  echo  '<input type="radio" id="steering_star5" name="steering_rating" value="'. $i .'" /><label style="color: #CC; for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
			  }?> 
			</div>
		</div>
	</div>
  </div>    
</div>  
<!-- Design Gears & Steering row ends -->            

<div class="w-100"></div> 

<!-- Wheels  & Saddle row starts -->
<div class="col-sm">            
  <div class="row w-100 mt-2">
	<div class="col-sm">
	  <div class="row">                
		<div class="col-sm text-center">
		  <label for="positiveFeedback3">Wheels:</label>
		</div>

		<div class="w-100"></div>

		<div class="col-sm starrating risingstar d-flex justify-content-center flex-row-reverse ml-1">
		  <?php 
			$rating = get_field('wheels_rating');
			for($i = 5; $i >= 1; $i-- ) { 
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
			  for($i = 5; $i >= 1; $i-- ) { 
				if($i <= $rating)
				  echo  '<input type="radio" id="saddle_star5" name="saddle_rating" value="'. $i .'" /><label style="color: #FF912C;" for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
				else
				  echo  '<input type="radio" id="saddle_star5" name="saddle_rating" value="'. $i .'" /><label style="color: #CC; for="star'.$i.'" title="'. $i .' star">'.$i.'</label>';
			}?> 
		  </div>
		</div>
	</div>
  </div>
</div>
<!-- Wheels & Saddle row ends -->       

<hr>
<div class="w-100"></div>

<div class="col-sm">      
  <legend>Likes / Dislikes:</legend>
</div>  

<div class="w-100"></div>

<!-- Like, Share Starts -->
<div class="col-sm">
  <div class="row">
	
	<!-- Like Starts -->          
	<div class="col-sm text-center mb-2">

	  <?php 
		/* GETTING THIS POST's LIKE AND DISLIKE OF LOGGED IN USER */
		$userId = get_current_user_id();

		$userLike    = ($userId != 1) ? (get_post_meta( get_the_ID(),  get_current_user_id() . '_like' ,   true) ) : 0;
		$userDislike = ($userId != 1) ? (get_post_meta( get_the_ID(),  get_current_user_id() . '_dislike', true) ) : 0;
		$totalLikes    =  get_field('review_likes', get_the_ID());
		$totalDisLikes =  get_field('review_dislikes', get_the_ID());
	  ?>

	  <button class="btn btn-lg btn-success btn-twitter btn-sm like_dislike_Btns" id="like_Btn" post_id="<?php echo get_the_ID(); ?>" field="review_likes" 
		<?php if(!is_user_logged_in() || $userLike == 1 || $userId == 1): ?>disabled <?php endif; ?>>
		<i class="fa fa-thumbs-up"></i>
		Likes
		<?php $totalLikes = $totalLikes ? $totalLikes : 0; ?><span>| <?php echo $totalLikes ; ?> </span>  
		
	  </button>

	  <button class="btn btn-lg btn-danger btn-twitter btn-sm like_dislike_Btns" id="dislike_Btn" post_id="<?php echo get_the_ID(); ?>" field="review_dislikes"
	  <?php 
		if(!is_user_logged_in() || $userDislike == 1): ?>disabled<?php endif; ?> >
		<i class="fa fa-thumbs-down"></i>
		Dislikes
		<?php $likes = get_field('review_dislikes', get_the_ID()); $likes = $likes ? $likes : 0; ?><span>| <?php echo $likes ; ?> </span>
	  </button>
	  
	</div>
	<!-- Like Ends -->

	<!-- Share Starts -->
	<div class="col-sm text-center mb-2">          
	  <?php
		echo do_shortcode("[wp_social_sharing social_options='facebook,twitter,linkedin,pinterest' twitter_username='' facebook_text='facebook' twitter_text='twitter' linkedin_text='linkedin' pinterest_text='pinterest' xing_text='Share on Xing' reddit_text='Share on Reddit' icon_order='f,t,l,p,x,r' show_icons='0' before_button_text='' text_position='' social_image='']");
	  ?>
	</div>
	<!-- Share Ends -->
  </div> 
  <!--/.row -->
</div>
<!-- Like, Share ends -->

</div><!--/.row -->

	

<?php 
      if ( comments_open() || get_comments_number() ) {
        comments_template();
      }
      ?>	

</div><!--/.container -->
<?php
get_footer();
