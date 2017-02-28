
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head();?>
</head>
<body>
  <header>
    <a class="title" href="<?php bloginfo( 'wpurl' );?>"><?php bloginfo('name') ?></a>
    <nav>
      <?php wp_nav_menu( [] ) ?>
    </nav>
  </header>