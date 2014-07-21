<?php
get_header(); ?>

  <div class="col-sm-9" id="content">

    <?php if ( have_posts() ) : ?>

      <header class="archive-header">
        <h4 class="archive-title">
          <?php printf( __( 'Search Results for: %s', 'dunham-2036' ), '<span>' . get_search_query() . '</span>' ); ?>
        </h4>
      </header>

      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', get_post_format() ); ?>
      <?php endwhile; ?>

      <?php dunham_2036_content_nav(); ?>

    <?php else : ?>

      <article id="post-0" class="post no-results not-found">
        <header class="archive-header">
          <h4 class="archive-title">
            <?php _e( 'Nothing Found', 'dunham-2036' ); ?>
          </h4>
        </header>

        <div class="entry-content">
          <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'dunham-2036' ); ?></p>
          <?php get_search_form(); ?>
        </div><!-- .entry-content -->
      </article><!-- #post-0 -->

    <?php endif; ?>

  </div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
