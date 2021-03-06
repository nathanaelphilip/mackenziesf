<?php
/**
 * @package beckett
 */

get_header(); ?>

	<div id="primary" class="">
    <main id="main" class="site-main" role="main">
      <div class="main-inside">
        <div class="template-contact__top clear">
          <div class="template-contact__top-box">
            <header class="main entry-header template-contact">
        			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        		</header><!-- .entry-header -->
          </div>
          <div class="template-contact__top-box">
      			<div>
        			<?php while ( have_posts() ) : the_post(); ?>
        				<?php get_template_part( 'content', 'page' ); ?>
        			<?php endwhile; // end of the loop. ?>
        			</div>
          </div>
        </div>
        <?php get_sidebar(); ?>
      </div>
    </main><!-- #main -->
<?php get_footer(); ?>
