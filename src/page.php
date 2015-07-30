<?php get_header(); ?>

<div class="col-sm-9" id="content">

  <?php while( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'content', 'page' ); ?>
    <?php comments_template( '', true ); ?>
  <?php endwhile; ?>

</div><!-- /#content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
