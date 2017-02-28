<main>
  <h2><a href="<?php echo get_permalink() ?>"><?php the_title() ?></a></h2>

  <?php if ( has_post_thumbnail() ) {
  the_post_thumbnail();
} ?>
  
</main>