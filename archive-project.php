<?php 

get_header(); 


$tag = get_queried_object();
 
?>
<main>
  <?php custom_breadcrumbs(); ?>
  <h1 class="title">Projects</h1>

  <?php
  $args =  [
    'post_type' => 'project',
    'meta_key' => 'date',
		'orderby' => 'meta_value',
    'order' => 'DESC',
  ];
  $project_query = new WP_Query( $args ); ?>
  <?php while ($project_query->have_posts()) : $project_query->the_post(); ?>
  <?php get_template_part( 'content', get_post_format() ); ?>

  <?php endwhile ?>

	<p class="text text-large text-center">etc.</p>

</main>
<?php get_footer(); ?>