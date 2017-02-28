<?php 

get_header(); 

 
?>
<style>
	.header-color,
	.meta {
		color: #fff;
		background-color: <?php echo get_post_meta($post->ID, "key_color", true) ?>;
	}
	img{
		width: 100%;
		height: auto;
	}
</style>

<div class="header-color">
	<h1><?php the_title(); ?></h1>
	<p><?php echo get_post_meta($post->ID, "tagline", true) ?></p>
	<?php if ( has_post_thumbnail() ) {
		the_post_thumbnail();
	} ?>
</div>

<?php if (count(get_the_tags()) > 0): ?>
<ul class="tags tags-inline">
	<?php foreach (get_the_tags() as $tag):?>
	<li><a href="<?php echo get_tag_link($tag->term_id) ?>"><?php echo ucwords($tag->name) ?></a></li>
	<?php endforeach ?>
</ul>
<?php endif ?>

<h2>Content</h2>
<?php the_content(); ?>

<div class="meta">
	<ul>
		<?php if (get_post_meta($post->ID, "date", true) != ""): ?>
		<li><?php echo strftime("%B %Y" ,strtotime(get_post_meta($post->ID, "date", true))) ?></li>
		<?php endif ?>
		<?php if (get_post_meta($post->ID, "location", true) != ""): ?>
		<li><?php echo get_post_meta($post->ID, "location", true) ?></li>
		<?php endif ?>
		<?php if (get_post_meta($post->ID, "for", true) != ""): ?>
		<li><?php echo get_post_meta($post->ID, "for", true) ?></li>
		<?php endif ?>
	</ul>
</div>

<a href="../">
	&lt; View other projects
</a>

<?php get_footer(); ?>