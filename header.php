
<!DOCTYPE html>
<html>
<head>
  <title><?php wp_title('-') ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
  <?php wp_head();?>
</head>
<body>
  <header>
    <a class="title" href="<?php bloginfo( 'wpurl' );?>"><?php bloginfo('name') ?></a>
    <nav>
      <?php wp_nav_menu( [] ) ?>
    </nav>
  </header>