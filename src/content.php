<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <?php
      if ( is_single() ) :
        the_title( '<h2 class="entry-title">', '</h2>' );
      else:
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
      endif;
    ?>
  </header>
  <div class="entry-date">
    <?php hesitant_entry_date(); ?>
  </div>
  <div class="entry-content">
    <?php if ( is_search() ) : ?>
      <?php the_excerpt(); ?>
    <?php else : ?>
      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'hesitant' ) ); ?>
      <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'hesitant' ), 'after' => '</div>') ); ?>
    <?php endif; ?>
  </div>
  <div class="entry-comments-link">
    <?php
    comments_popup_link(
      __( 'Leave a reply', 'hesitant' ),
      __( '1 Reply', 'hesitant' ),
      __( '% Replies', 'hesitant' )
    );
    ?>
  </div>
  <footer class="entry-meta">
    <?php hesitant_entry_meta(); ?>
    <?php edit_post_link( __( 'Edit', 'hesitant' ) ); ?>
  </footer>
</article>
