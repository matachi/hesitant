<?php get_header(); ?>

<div class="col-sm-9" id="content">

  <?php if ( have_posts() ) : ?>
    <header class="archive-header">
      <h4 class="archive-title">
        <?php printf( __( 'Category Archives: %s', 'dunham-2036' ), single_cat_title( '', false ) ); ?>
      </h4>
      <?php if ( category_description() ) : ?>
        <div class="archive-meta"><?php echo category_description(); ?></div>
      <?php endif; ?>
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
