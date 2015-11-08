<?php get_header(); ?>

<div class="col-sm-10 col-sm-offset-1" id="content">

  <?php while( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'content', get_post_format() ); ?>

    <ul class="pager" role="navigation">
      <li class="previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'hesitant' ) . '</span> %title' ); ?></li>
      <li class="next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'hesitant' ) . '</span>' ); ?></li>
    </ul>

    <?php get_template_part( 'content', 'ad' ); ?>

    <?php comments_template( '', true ); ?>

  <?php endwhile; ?>

</div><!-- /#content -->

<?php get_footer(); ?>
