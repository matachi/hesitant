<?php get_header(); ?>

<div class="col-sm-9" id="content">

  <?php if ( have_posts() ) : ?>
    <header class="archive-header">
      <h4 class="archive-title">
        <?php
        if ( is_day() ) :
          printf( __( 'Daily Archives: %s', 'dunham-2036' ), get_the_date() );
        elseif ( is_month() ) :
          printf( __( 'Monthly Archives: %s', 'dunham-2036' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'dunham-2036' ) ) );
        elseif ( is_year() ) :
          printf( __( 'Yearly Archives: %s', 'dunham-2036' ), get_the_date( _x( 'Y', 'yearly archives date format', 'dunham-2036' ) ) );
        else :
          _e( 'Archives', 'dunham-2036' );
        endif;
        ?>
      </h4>
    </header>

    <?php
    while( have_posts() ) : the_post();
      get_template_part( 'content', get_post_format() );
    endwhile;

    dunham_2036_content_nav();
    ?>

  <?php else : ?>
    <?php get_template_part( 'content', 'none' ); ?>
  <?php endif; ?>

</div><!-- /#content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
