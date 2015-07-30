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
  wp_enqueue_style( 'hesitant-fonts', esc_url_raw( 'http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic' ) );
  wp_enqueue_style( 'hesitant-style', get_stylesheet_uri(), 'hesitant-fonts', '20150730' );
  wp_enqueue_script( 'hesitant-script', get_template_directory_uri() . '/js/scripts.min.js', [], '20150730', true );
}
add_action( 'wp_enqueue_scripts', 'hesitant_scripts_styles' );

function hesitant_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Sidebar', 'hesitant' ),
    'id' => 'sidebar-1',
    'description' => __( 'Appears on all pages to the right', 'twentytwelve' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );
}
add_action( 'widgets_init', 'hesitant_widgets_init' );

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

function hesitant_entry_meta() {
  $categories_list = get_the_category_list( __( ', ', 'hesitant' ) );

  $date = sprintf( '<a href="%1$s" title="Permalink to the post" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a>',
    esc_url( get_permalink() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() . ' ' . get_the_time() )
  );

  printf(
    __( 'This entry was posted in %1$s on %2$s.', 'hesitant' ),
    $categories_list,
    $date
  );
}

