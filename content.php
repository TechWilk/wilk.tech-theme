<article class="post<?php echo get_the_ID() ?> cropped-image teaser">
  <style>
    .post<?php echo get_the_ID() ?> .header-color,
    .post<?php echo get_the_ID() ?> .meta,
    .post<?php echo get_the_ID() ?> blockquote {
      color: #fff;
      background-color: <?php echo get_post_meta($post->ID, "key_color", true) ?>;
    }
    .post<?php echo get_the_ID() ?> .header-color a {
      color: #fff;
    }
  </style>

  <div class="header-color">
    <h2><?php the_title() ?></h2>
    <p><?php echo get_post_meta(get_the_ID(), "tagline", true) ?></p>
    
    <?php if (count(get_the_tags()) > 0): ?>
    <ul class="tags tags-inline tags-inline-comma">
      <?php foreach (get_the_tags() as $tag):?>
      <li><a href="<?php echo get_tag_link($tag->term_id) ?>"><?php echo ucwords($tag->name) ?></a></li>
      <?php endforeach ?>
    </ul>
    <?php endif ?>
    <p>
      <a class="more" href="<?php echo get_permalink() ?>">
        more info >
      </a>
    </p>
  </div>

  <?php if ( has_post_thumbnail() ) {
  the_post_thumbnail();
  } ?>
</article>