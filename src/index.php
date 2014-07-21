<?php get_header(); ?>

<div class="col-sm-9" id="content">

  <?php
    if ( have_posts() ) :

      while( have_posts() ) : the_post();
        get_template_part( 'content', get_post_format() );
      endwhile;

      dunham_2036_content_nav();

    endif;
  ?>

</div><!-- /#content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
