<?php 

get_header(); 
the_post(); // set the current post

 
?>
<main>
  <h1 class="title"><?php the_title() ?></h1>


  <div class="content">
    <?php the_content() ?>
  </div>
</main>
<?php get_footer(); ?>