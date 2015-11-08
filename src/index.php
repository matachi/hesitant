<?php get_header(); ?>

<div class="col-sm-10 col-sm-offset-1" id="content">

  <?php
    if ( have_posts() ) :

      while( have_posts() ) : the_post();
        get_template_part( 'content', get_post_format() );
      endwhile;

      hesitant_content_nav();

    endif;
  ?>

</div><!-- /#content -->

<?php get_footer(); ?>
