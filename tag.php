<?php 

get_header(); 


$tag = get_queried_object();
 
?>
<main>
  <h1><?php echo ucwords($tag->name) ?> projects</h1>
  <?php if (!empty($tag->description)): ?>
  <p><?php echo $tag->description ?></p>
  <?php endif ?>

  <?php
  $args =  [
    'post_type' => 'project',
    'meta_key' => 'date',
		'orderby' => 'meta_value',
    'order' => 'DESC',
    'tag' => $tag->slug
  ];
  $project_query = new WP_Query( $args ); ?>
  <?php while ($project_query->have_posts()) : $project_query->the_post(); ?>
  <div>
    <?php get_template_part( 'content', get_post_format() ); ?>
  </div>  

  <?php endwhile ?>

</main>
<?php get_footer(); ?>