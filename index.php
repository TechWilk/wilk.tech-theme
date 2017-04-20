<?php get_header(); ?>

<main>
  <h1 class="site-title">Christopher Wilkinson</h1>
  <p class="site-tagline">Interactive Multimedia Specialist</p>

  <?php if (count(get_tags()) > 0): ?>
  <p class="text-large text-center text-hidden text-show-wide">Key Skills:</p>
  <ul class="tags tags-center tags-inline-wide tags-inline-wide-slash">
    <?php foreach (get_tags() as $tag):?>
    <li><a href="<?php echo get_tag_link($tag->term_id) ?>"><?php echo ucwords($tag->name) ?></a></li>
    <?php endforeach ?>
  </ul>
  <?php endif ?>

  <p class="text-large text-center show-hidden show-wide">Recent projects:</p>
  <div class="show-hidden show-wide">
    <?php
    $args =  [
      'post_type' => 'project',
      'meta_key' => 'date',
      'orderby' => 'meta_value',
      'order' => 'DESC',
      'posts_per_page' => '2',
    ];
    $project_query = new WP_Query( $args ); ?>
    <?php while ($project_query->have_posts()) : $project_query->the_post(); ?>
    <?php get_template_part( 'content', get_post_format() ); ?>

    <?php endwhile ?>

    <p><a href="project/" class="button text text-large">view all &gt;</a></p>
  </div>
</main>

<?php get_footer(); ?>