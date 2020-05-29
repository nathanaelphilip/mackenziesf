<?php
  /**
    Template Name: Contact
  **/

  get_header();
?>

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
        <div class="template-contact__bottom clear">
          <div class="template-contact__bottom-box">
            <?php Ninja_Forms()->display(1) ?>
          </div>
          <div class="template-contact__bottom-box template-contact__info">
            <p>
              MacKenzie Communications<br>
              275 Battery Street, Suite 900<br>
              San Francisco, CA 94111
            </p>
            <p>
              Email us at <a href="mailto:sarah@mackenziesf.com">sarah@mackenziesf.com</a><br>
              Call us at 415.403.0800
            </p>
          </div>
        </div>
      </div>
    </main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
