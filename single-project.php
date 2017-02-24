<?php 

get_header(); 

 
?>
<style>
	h1 {
		color: <?php echo get_post_meta($post->ID, "key_color", true) ?>;
	}
</style>

<h1><?php the_title(); ?></h1>

<h2>Content</h2>
<?php the_content(); ?>

<?php get_footer(); ?>