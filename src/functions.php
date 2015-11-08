<?php
if ( ! isset( $content_width ) )
  $content_width = 800;

function hesitant_setup() {
  load_theme_textdomain( 'hesitant', get_template_directory() . '/languages' );

  // Add editor-style.css that matches the theme's style.
  add_editor_style();
  add_theme_support( 'automatic-feed-links' );
  register_nav_menu( 'primary', __( 'Primary Menu', 'hesitant' ) );
}
add_action( 'after_setup_theme', 'hesitant_setup' );

function hesitant_scripts_styles() {
  wp_enqueue_style( 'hesitant-fonts', esc_url_raw( 'http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic|Libre+Baskerville' ) );
  wp_enqueue_style( 'hesitant-style', get_stylesheet_uri(), 'hesitant-fonts', '20151108' );
  wp_enqueue_script( 'hesitant-script', get_template_directory_uri() . '/js/scripts.min.js', [], '20150730', true );
  wp_enqueue_script( 'jquery-core' );
}
add_action( 'wp_enqueue_scripts', 'hesitant_scripts_styles' );

function hesitant_wp_title( $title, $sep ) {
  global $paged, $page;
  if ( is_feed() )
    return $title;

  // Add the site name.
  $title .= get_bloginfo( 'name', 'display' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 )
    $title = "$title $sep " . sprintf( __( 'Page %s', 'hesitant' ), max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'hesitant_wp_title', 10, 2 );

function hesitant_content_nav() {
  global $wp_query;
  if ( $wp_query->max_num_pages > 1 ) : ?>
    <ul class="pager" role="navigation">
      <li class="previous"><?php next_posts_link( __( '&larr; Older posts', 'hesitant' ) ); ?></li>
      <li class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'hesitant' ) ); ?></li>
    </ul>
  <?php endif;
}

function hesitant_entry_date() {
  $date = sprintf( '<time class="entry-date" datetime="%1$s">%2$s</time>',
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() . ' – ' . get_the_time() )
  );
  print($date);
}

function hesitant_entry_meta() {
  $categories_list = get_the_category_list( __( ', ', 'hesitant' ) );
  printf(
    __( 'This entry was posted in: %1$s.', 'hesitant' ),
    $categories_list
  );
}

