<?php 

get_header(); 

 
?>

<h1>Projects</h1>

<?php if (count(get_tags()) > 0): ?>
<ul class="tags tags-center">
	<?php foreach (get_tags() as $tag):?>
	<li><a href="<?php echo get_tag_link($tag->term_id) ?>"><?php echo ucwords($tag->name) ?></a></li>
	<?php endforeach ?>
</ul>
<?php endif ?>

<?php get_footer(); ?>