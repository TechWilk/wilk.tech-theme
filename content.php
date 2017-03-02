<article class="post<?php echo get_the_ID() ?>">
  <style>
    .post<?php echo get_the_ID() ?> .header-color,
    .post<?php echo get_the_ID() ?> .meta,
    .post<?php echo get_the_ID() ?> blockquote {
      color: #fff;
      background-color: <?php echo get_post_meta($post->ID, "key_color", true) ?>;
    }
  </style>
  <a href="<?php echo get_permalink() ?>">
    <div class="header-color">
      <h2><?php the_title() ?></h2>
    </div>

    <?php if ( has_post_thumbnail() ) {
    the_post_thumbnail();
  } ?>
  </a>
</article>