<?php
/**
 * Template Name: Bio
 * @package beckett
 */

get_header(); ?>

	<div id="primary" class="">
    <main id="main" class="site-main" role="main">
      <div class="main-inside">
        <div class="template-contact__top clear">
          <div class="template-contact__top-box">
            <figure class="template-bio__image thumbnail">
              <?php the_post_thumbnail('large') ?>
            </figure>
            <header class="main entry-header template-contact">
        			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
              <p><?php the_field('position') ?></p>
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
