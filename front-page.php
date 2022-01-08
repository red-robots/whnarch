<?php
/**
 * The template for homepage
 *
 */
get_header();
?>

  <div id="primary" class="content-area home-content">
    <main id="main" class="site-main">

      <?php while ( have_posts() ) : the_post(); ?>
        <header class="entry-header">
          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header>

        <div class="entry-content">
          <?php the_content(); ?>
        </div><!-- .entry-content -->

      <?php endwhile;  ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();
