<?php

if (is_single()) { // if a post, set as current
  the_post();
  $postColor = get_post_meta($post->ID, "key_color", true);
}

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="<?php echo isset($postColor) ? $postColor : '#db5945' ?>">
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-96319792-1', 'auto');
    ga('send', 'pageview');
  </script>
  <?php wp_head();?>
</head>
<body <?php echo body_class() ?>>
  <header>
    <a class="title" href="<?php bloginfo( 'wpurl' );?>"><?php bloginfo('name') ?></a>
    <input type="checkbox" name="hamburger" id="hamburger" />
    <label for="hamburger" class="hamburger">
      <span class="line"></span>
      <span class="line"></span>
      <span class="line"></span>
    </label>
    <nav>
      <ul>
        <li <?php echo is_home() ? 'class="current-menu-item"' : '' ?>><a href="<?php bloginfo( 'wpurl' );?>">Home</a></li>
        <?php wp_nav_menu( ['container' => false, 'items_wrap' => '%3$s'] ) ?>
      </ul>
    </nav>
  </header>