<?php
if ( ! isset( $content_width ) )
  $content_width = 800;

function dunham_2036_setup() {
  load_theme_textdomain( 'dunham-2036', get_template_directory() . '/languages' );

  // Add editor-style.css that matches the theme's style.
  add_editor_style();
  add_theme_support( 'automatic-feed-links' );
  register_nav_menu( 'primary', __( 'Primary Menu', 'dunham-2036' ) );
}
add_action( 'after_setup_theme', 'dunham_2036_setup' );

function dunham_2036_scripts_styles() {
  wp_enqueue_style( 'dunham-2036-fonts', esc_url_raw( 'http://fonts.googleapis.com/css?family=Fira+Sans:400,400italic,500,700,700italic' ) );
  wp_enqueue_style( 'dunham-2036-style', get_stylesheet_uri() );
  wp_enqueue_script( 'dunham-2036-script', get_template_directory_uri() . '/js/scripts.min.js', [], '20140720', true );
}
add_action( 'wp_enqueue_scripts', 'dunham_2036_scripts_styles' );

function dunham_2036_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Sidebar', 'dunham-2036' ),
    'id' => 'sidebar-1',
    'description' => __( 'Appears on all pages to the right', 'twentytwelve' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );
}
add_action( 'widgets_init', 'dunham_2036_widgets_init' );

function dunham_2036_wp_title( $title, $sep ) {
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
    $title = "$title $sep " . sprintf( __( 'Page %s', 'dunham-2036' ), max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'dunham_2036_wp_title', 10, 2 );

function dunham_2036_content_nav() {
  global $wp_query;
  if ( $wp_query->max_num_pages > 1 ) : ?>
    <ul class="pager" role="navigation">
      <li class="previous"><?php next_posts_link( __( '&larr; Older posts', 'dunham-2036' ) ); ?></li>
      <li class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'dunham-2036' ) ); ?></li>
    </ul>
  <?php endif;
}

function dunham_2036_entry_meta() {
  $categories_list = get_the_category_list( __( ', ', 'dunham-2036' ) );

  $date = sprintf( '<a href="%1$s" title="Permalink to the post" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a>',
    esc_url( get_permalink() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() . ' ' . get_the_time() )
  );

  printf(
    __( 'This entry was posted in %1$s on %2$s.', 'dunham-2036' ),
    $categories_list,
    $date
  );
}

