
<div class="meta-page">
	<i class="far fa-clock"></i>
	<?php the_time('F j, Y g:i a'); ?>  &nbsp;-&nbsp; 
	<i class="fas fa-pen-nib"></i>
	By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
</div>
<div class="text" <?php post_class(); ?>>

	<?php the_content(); ?>

</div>
<div class="tag">
	<?php 
		$tags = get_the_tags();
		if ($tags <> "") {
			echo '<i class="fas fa-tags"></i> ';
			foreach($tags as $tag)
			{
				echo '<a href="'. get_tag_link($tag->term_id) . '">' . $tag->name . '</a>, ';
			}
		}
		
	?>
</div>
<?php 

comments_template();

?>
