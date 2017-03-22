<?php get_header(); ?>

<main>
  <h1 class="site-title">Christopher Wilkinson</h1>
  <p class="site-tagline">Interactive Multimedia Specialist</p>

  <?php if (count(get_tags()) > 0): ?>
  <ul class="tags tags-center">
    <?php foreach (get_tags() as $tag):?>
    <li><a href="<?php echo get_tag_link($tag->term_id) ?>"><?php echo ucwords($tag->name) ?></a></li>
    <?php endforeach ?>
  </ul>
  <?php endif ?>

</main>

<?php get_footer(); ?>