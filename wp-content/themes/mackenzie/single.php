<?php
/**
 * The Template for displaying all single posts.
 *
 * @package beckett
 */

get_header(); ?>

<div id="primary">
	
	<main id="main" class="site-main" role="main">
		<div class="main-inside clear">
		<div class="content-area">
	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php beckett_post_nav(); ?>			
				
			<?php if ( comments_open() || '0' != get_comments_number() ) : // If comments are open or we have at least one comment, load up the comment template?>
					<div class="comments-wrap">
						<?php comments_template(); ?>
					</div>
			<?php endif; ?>

		<?php endwhile; // end of the loop. ?>
	<?php endif; ?>
      
      <div>
        <a href="<?= get_permalink(get_option('page_for_posts')) ?>">Return to blog</a>
      </div>

	</div>
	<?php get_sidebar(); ?>
	</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
