<?php
/**
 * Template Name: Projects
 *
 */
get_header(); ?>
<div id="primary" class="content-area default-template parent-page">
	<main id="main" class="site-main wrapper">
		<?php while ( have_posts() ) : the_post(); ?>
      <header class="entry-title" style="display:none"><h1 class="page-title"><?php the_title(); ?></h1></header>
      <?php if (get_the_content()) { ?>
      <section class="entry-content"><?php the_content(); ?></section>
      <?php } ?>
		<?php endwhile; ?>	

    <?php  
    $current_page = get_permalink();
    $taxonomy = 'project-categories';
    $terms = get_terms( $taxonomy, array( 'hide_empty' => true, 'parent' => 0 ) );
    if($terms) { ?>

      <div class="categories">
        <a href="<?php echo $current_page ?>">All</a>
        <?php foreach ($terms as $term) { 
          $term_link = get_term_link($term, $taxonomy);
          $term_name = $term->name;
          ?>
          <a href="<?php echo $term_link ?>"><?php echo $term_name ?></a>
        <?php } ?>
      </div>

    <?php } ?>

    <?php
    $placeholder = THEMEURI . 'images/rectangle-lg.png';
    $paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
    $postype = 'projects';
    $args = array(
      'posts_per_page'=> 9,
      'post_type'   => $postype,
      'post_status' => 'publish',
      'paged'     => $paged
    );
    $projects = new WP_Query($args);
    if ( $projects->have_posts() ) {  ?> 
    <div class="project-columns">
      <div class="flexwrap">
      <?php $i=1; while ( $projects->have_posts() ) : $projects->the_post(); ?>
        <?php  
          $pagelink = get_permalink();
          $thumbnail = get_field("thumbnail");
          $has_image = ($thumbnail) ? 'has-thumbnail':'no-thumbnail';
        ?>
        <div class="box">
          <a href="<?php echo $pagelink ?>" class="link <?php echo $has_image ?>">
            <?php if ($thumbnail) { ?>
            <span class="image" style="background-image:url('<?php echo $thumbnail['url'] ?>')"></span> 
            <?php } ?>
            <img src="<?php echo $placeholder ?>" alt="" aria-hidden="true">
            <span class="view"><span class="plus"></span></span>
          </a>
          <p class="project-name"><a href="<?php echo $pagelink ?>"><?php the_title(); ?></a></p>
        </div>
      <?php $i++; endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
    <?php } ?>

	</main>
</div>
<?php
get_footer();
