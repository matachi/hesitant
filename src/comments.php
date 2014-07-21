<?php
if ( post_password_required() )
  return;
?>

<div id="comments" class="comments-area">

  <?php if ( have_comments() ) : ?>
    <h3 class="comments-title">
      <?php
        printf(
          _n(
            'One thought on &ldquo;%2$s&rdquo;',
            '%1$s thoughts on &ldquo;%2$s&rdquo;',
            get_comments_number(),
            'dunham-2036'
          ),
          number_format_i18n( get_comments_number() ),
          get_the_title()
        );
      ?>
    </h3>

    <ol class="commentlist">
      <?php wp_list_comments( array( 'style' => 'ol' ) ); ?>
    </ol><!-- .commentlist -->

    <?php
    // If there are comments to navigate through.
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
      <nav id="comment-nav-below" class="navigation" role="navigation">
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'dunham-2036' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'dunham-2036' ) ); ?></div>
      </nav>
    <?php endif; ?>

    <?php
    // If the post or page has comments and the comments are closed.
    if ( ! comments_open() ) : ?>
      <p class="nocomments"><?php _e( 'Comments are closed.' , 'dunham-2036' ); ?></p>
    <?php endif; ?>

  <?php endif; // have_comments() ?>

  <?php comment_form(); ?>

</div><!-- #comments .comments-area -->
