<?php 

get_header(); 
the_post(); // set the current post

 
?>
<?php custom_breadcrumbs(); ?>
<h1 class="title"><?php the_title() ?></h1>


<div class="content">
  <?php the_content() ?>
</div>

<?php get_footer(); ?>