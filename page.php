<?php 

get_header(); 
the_post(); // set the current post

 
?>

<h1><?php the_title() ?></h1>

<div class="content">
  <?php the_content() ?>
</div>

<?php get_footer(); ?>