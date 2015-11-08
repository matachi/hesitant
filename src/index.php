<?php get_header(); ?>

<div class="col-sm-10 col-sm-offset-1" id="content">

  <?php
    if ( have_posts() ) :

      $counter = 0;
      while( have_posts() ) : the_post();
        // Content
        get_template_part( 'content', get_post_format() );

        // Ad
        set_query_var( 'hesitant_ad_id', $counter++ );
        get_template_part( 'content', 'ad' );
        ;
      endwhile;

      hesitant_content_nav();

    endif;
  ?>

</div><!-- /#content -->

<?php get_footer(); ?>
