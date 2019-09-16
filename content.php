<div class="row single-post">
	
	<div class="col-12 post-img">
	<?php 
	$var = get_the_post_thumbnail_url ();

	if($var <> ""){
	?>
		<a href="<?php the_permalink(); ?>">
			<img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-fluid" style="width:100%">
		</a>
		<?php
	}
	?>
	</div>
		<div class="col-10 offset-1 post-block">
			<div class="excerpt">
				<h2>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<div class="meta">
					<i class="far fa-clock"></i>
					<?php the_time('F j, Y g:i a'); ?> - 
					<i class="fas fa-pen-nib"></i>
					By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
				</div>
				<div class="text">
				<?php
				
				the_excerpt_max_charlength(1200);
				
				?>
				</div>
				<div class="readmore">
					<a href="<?php the_permalink(); ?>">Read More &raquo;</a>
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
			</div>
		</div>
</div>


