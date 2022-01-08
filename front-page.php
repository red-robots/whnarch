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
        <header class="entry-header" style="display:none">
          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header>

        <div class="entry-content">
          <div class="intro text-center">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
          <?php the_content(); ?>
        </div><!-- .entry-content -->

      <?php endwhile;  ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();
