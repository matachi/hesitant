<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <link rel="icon" href="favicon.ico">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <!--[if lt IE 9]>
      <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
  </head>
  <body>

    <div id="header">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img id="header" src="<?php echo get_template_directory_uri() . '/img/header.jpg' ?>">
      </a>
    </div>

    <div class="container-fluid">

      <nav id="site-navigation" role="navigation">
        <button type="button" class="btn menu-toggle"><?php _e( 'Menu', 'hesitant' ); ?></button>
        <?php wp_nav_menu( array(
          'theme_location' => 'primary',
          'container' => false
        ) ); ?>
      </nav>

      <div class="row" id="main">
