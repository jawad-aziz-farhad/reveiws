<?php get_header(); ?>

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
        <h1 class="mt-4"><?php echo $author_name; ?></h1>
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
    <div class="col-sm mb-1">
      <label for="like_level">Like Level: <?php echo get_field('like_level');?></label>                
    </div>

    <div class="w-100"></div>
    
    <div class="col-sm mb-1">       
      <input type="range" class="w-100" name="right_wrong" id="like_level" min="1" max="10" value="<?php echo get_field('like_level');?>" disabled>
    </div>
    <!-- Bike Liking/ Disliking ends -->

  </div>
  <!-- /.row -->

  </div>
  <!-- /.container -->

<?php get_footer(); ?>