<?php get_header(); ?>

<div class="col-sm-10 col-sm-offset-1" id="content">

  <?php if ( have_posts() ) : ?>
    <header class="archive-header">
      <h4 class="archive-title">
        <?php printf( __( 'Category Archives: %s', 'hesitant' ), single_cat_title( '', false ) ); ?>
      </h4>
      <?php if ( category_description() ) : ?>
        <div class="archive-meta"><?php echo category_description(); ?></div>
      <?php endif; ?>
    </header>

    <?php
    $counter = 0;
    while( have_posts() ) : the_post();
      get_template_part( 'content', get_post_format() );

      // Ad
      set_query_var( 'hesitant_ad_id', $counter++ );
      get_template_part( 'content', 'ad' );
    endwhile;

    hesitant_content_nav();
    ?>

  <?php else : ?>
    <?php get_template_part( 'content', 'none' ); ?>
  <?php endif; ?>

</div><!-- /#content -->

<?php get_footer(); ?>
