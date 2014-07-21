<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <!--[if lt IE 9]>
      <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
  </head>
  <body>

    <img id="header" src="http://misslisibell.se/wp-content/uploads/2014/03/header.jpg">

    <div class="container-fluid">

      <nav id="site-navigation" role="navigation">
        <button type="button" class="btn menu-toggle"><?php _e( 'Menu', 'dunham-2036' ); ?></button>
        <?php wp_nav_menu( array(
          'theme_location' => 'primary',
          'container' => false
        ) ); ?>
      </nav>

      <div class="row" id="main">
