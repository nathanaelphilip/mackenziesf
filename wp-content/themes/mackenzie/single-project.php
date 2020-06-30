<?php

get_header(); ?>

	<div id="primary" class="">
		<main id="main" class="site-main" role="main">
			<div class="main-inside clear">
			<div class="content-area">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'project-single' ); ?>

			<?php beckett_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>
		</div>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
