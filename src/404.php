<?php
get_header(); ?>

  <div class="col-sm-9" id="content">

    <article id="post-0" class="post error404">
      <header class="entry-header">
        <h2 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'hesitant' ); ?></h1>
      </header>

      <div class="entry-content">
        <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'hesitant' ); ?></p>
        <?php get_search_form(); ?>
      </div><!-- .entry-content -->
    </article><!-- #post-0 -->

  </div><!-- #content -->

<?php get_footer(); ?>
