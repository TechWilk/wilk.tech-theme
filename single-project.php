<?php 

get_header(); 

$postColor = get_post_meta($post->ID, "key_color", true);

?>
<style>
	.post<?php echo get_the_ID() ?> .header-color,
	.post<?php echo get_the_ID() ?> .meta,
	.post<?php echo get_the_ID() ?> blockquote,
	.post<?php echo get_the_ID() ?> .content a:hover {
		color: #fff;
		background-color: <?php echo $postColor ?>;
	}
	.post<?php echo get_the_ID() ?> .content img,
	.post<?php echo get_the_ID() ?> .content .wp-video,
	.post<?php echo get_the_ID() ?> .content iframe {
		border-color: <?php echo $postColor ?>;
	}
	.post<?php echo get_the_ID() ?> .content a {
		color: <?php echo $postColor ?>;
	}
</style>

<article class="post<?php echo get_the_ID() ?>">
	<div class="header-color cropped-image">
		<?php if ( has_post_thumbnail() ) {
			the_post_thumbnail();
		} ?>
		<h1><?php the_title(); ?></h1>
		<p><?php echo get_post_meta($post->ID, "tagline", true) ?></p>
	</div>

	<div class="section">
		<?php if (count(get_the_tags()) > 0): ?>
		<ul class="tags tags-inline tags-center tags-inline-slash">
			<?php foreach (get_the_tags() as $tag):?>
			<li><a href="<?php echo get_tag_link($tag->term_id) ?>"><?php echo ucwords($tag->name) ?></a></li>
			<?php endforeach ?>
		</ul>
		<?php endif ?>
	</div>

	<div class="content">
		<?php the_content(); ?>
	</div>

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
</article>

<div class="section">
	<a href="../" class="button text text-large">
		&lt; view other projects
	</a>
</div>

<?php get_footer(); ?>