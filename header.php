
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
    <input type="checkbox" name="hamburger" id="hamburger" />
    <label for="hamburger" class="hamburger">
      <span class="line"></span>
      <span class="line"></span>
      <span class="line"></span>
    </label>
    <nav>
      <?php wp_nav_menu( ['container' => false] ) ?>
    </nav>
  </header>