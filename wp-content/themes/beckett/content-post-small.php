<div <?php post_class('small'); ?>>	
	<div class="inside">
	
	<?php if(has_post_thumbnail()) : ?>			
		<a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_post_thumbnail('beckett_post_thumb_small', array('class' => 'postThumb alignleft', 'alt' => ''.get_the_title().'', 'title' => ''.get_the_title().'')); ?></a>
	<?php endif; ?>	
		
	<span class="meta date">
		<?php beckett_posted_on();?>		
	</span>
	<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_title(); ?></a></h2>	
	<?php the_excerpt(); ?>
	<?php beckett_more_link(); ?>
	</div>
</div>