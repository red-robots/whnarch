<?php
/**
 * Template Name: Sitemap
 *
 */
get_header(); ?>
<div id="primary" class="content-area default-template projects-page parent-page">
	<main id="main" class="site-main wrapper">
		<?php while ( have_posts() ) : the_post(); ?>
      <header class="entry-title"><h1 class="page-title"><?php the_title(); ?></h1></header>

      <?php if ( get_the_content() ) { ?>
      <section class="entry-content"><?php the_content(); ?></section>
      <?php } ?>

      <?php if ( has_nav_menu('sitemap') ) { ?>
      <div id="sitemap-wrap">
      <?php wp_nav_menu( array( 'theme_location' => 'sitemap', 'menu_id' => 'sitemap','container_class'=>'sitemap-links') ); ?>
      </div>
      <?php } ?>

    <?php endwhile; ?>  
	</main>
</div>
<?php
get_footer();
