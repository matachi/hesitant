<?php get_header(); ?>

<div class="col-sm-10 col-sm-offset-1" id="content">

  <?php if ( have_posts() ) : ?>
    <header class="archive-header">
      <h4 class="archive-title">
        <?php
        if ( is_day() ) :
          printf( __( 'Daily Archives: %s', 'hesitant' ), get_the_date() );
        elseif ( is_month() ) :
          printf( __( 'Monthly Archives: %s', 'hesitant' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'hesitant' ) ) );
        elseif ( is_year() ) :
          printf( __( 'Yearly Archives: %s', 'hesitant' ), get_the_date( _x( 'Y', 'yearly archives date format', 'hesitant' ) ) );
        else :
          _e( 'Archives', 'hesitant' );
        endif;
        ?>
      </h4>
    </header>

    <?php
    while( have_posts() ) : the_post();
      get_template_part( 'content', get_post_format() );
    endwhile;

    hesitant_content_nav();
    ?>

  <?php else : ?>
    <?php get_template_part( 'content', 'none' ); ?>
  <?php endif; ?>

</div><!-- /#content -->

<?php get_footer(); ?>
