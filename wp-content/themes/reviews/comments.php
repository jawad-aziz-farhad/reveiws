<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav id="comment-nav-above" class="comment-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'triday' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( '← Older Comments', 'triday' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments →', 'triday' ) ); ?></div>
    </nav><!-- #comment-nav-above -->
    <?php endif; // check for comment navigation ?>

    <ol class="comment-list">
        <?php
            /* Loop through and list the comments. Tell wp_list_comments()
             * to use triday_comment() to format the comments.
             * If you want to override this in a child theme, then you can
             * define triday_comment() and that will be used instead.
             * See triday_comment() in inc/template-tags.php for more.
             */
             wp_list_comments( array( 'callback' => 'triday_comment' ) );
            ?>

    </ol><!-- .comment-list -->

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav id="comment-nav-below" class="comment-navigation" role="navigation">
        <h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'triday' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( '← Older Comments', 'triday' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments →', 'triday' ) ); ?></div>
    </nav><!-- #comment-nav-below -->
    <?php endif; // check for comment navigation ?>

<!--</div>-->
<?php //comment_form(); ?>