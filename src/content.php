<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <?php
      if ( is_single() ) :
        the_title( '<h2 class="entry-title">', '</h2>' );
      else:
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
      endif;
    ?>
    <div class="comments-link">
      <?php
        comments_popup_link(
          __( 'Leave a reply', 'dunham-2036' ),
          __( '1 Reply', 'dunham-2036' ),
          __( '% Replies', 'dunham-2036' )
        );
      ?>
    </div>
  </header>
  <div class="entry-content">
    <?php if ( is_search() ) : ?>
      <?php the_excerpt(); ?>
    <?php else : ?>
      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'dunham-2036' ) ); ?>
      <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'dunham-2036' ), 'after' => '</div>') ); ?>
    <?php endif; ?>
  </div>
  <footer class="entry-meta">
    <?php dunham_2036_entry_meta(); ?>
    <?php edit_post_link( __( 'Edit', 'dunham-2036' ) ); ?>
  </footer>
</article>
