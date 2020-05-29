<?php
/**
 * Template Name: About
 * @package beckett
 */

get_header(); ?>
<div class="site-main">
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
</div>
<?php if (get_field('image')): ?>
  <div class="home">
    <section style="padding: 0px">
      <header class="has-background" style="background-image: url(<?= wp_get_attachment_image_url(get_field('image'), 'full') ?>)"></header>
    </section>
  </div>
<?php endif; ?>
<div id="approach" class="site-main">
  <div class="main-inside">
    <div class="template-contact__top clear">
      <div class="template-contact__top-box">
        <header class="main entry-header template-contact">
          <h1 class="entry-title">Our Approach</h1>
        </header><!-- .entry-header -->
      </div>
      <div class="template-contact__top-box">
        <div>
          <?php while(have_rows('our_approach')): the_row(); ?>
            <?php the_sub_field('content') ?>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
<div id="clients" class="site-main">
  <div class="main-inside">
    <div class="template-contact__top clear">
      <div class="template-contact__top-box">
        <header class="main entry-header template-contact">
          <h1 class="entry-title">Clients We’ve Served</h1>
        </header><!-- .entry-header -->
      </div>
      <div class="template-contact__top-box">
        <div class="block-logos clear">
          <?php while(have_rows('clients')): the_row(); ?>
            <?php while(have_rows('logos')): the_row(); ?>
              <div class="card-logo" style="background-image: url(<?php the_sub_field('image') ?>)">
                <img src="//placehold.it/180x180" calss="card-logo__placeholder" alt="">
              </div>
            <?php endwhile; ?>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>
