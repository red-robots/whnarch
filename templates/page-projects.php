<?php
/**
 * Template Name: Projects
 *
 */
get_header(); ?>
<div id="primary" class="content-area default-template projects-page parent-page">
	<main id="main" class="site-main wrapper">
		<?php while ( have_posts() ) : the_post(); ?>
      <header class="entry-title" style="display:none"><h1 class="page-title"><?php the_title(); ?></h1></header>
      <?php if (get_the_content()) { ?>
      <section class="entry-content"><?php the_content(); ?></section>
      <?php } ?>
		<?php endwhile; ?>	

    <?php  
    $current_page = get_permalink();
    $isAll = true;
    include( locate_template('parts/project-categories-breadcrumb.php') );
    $placeholder = THEMEURI . 'images/rectangle-lg.png';
    $paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
    $posttype = 'projects';
    $perpage = (get_field("projects_perpage","option")) ? get_field("projects_perpage","option") : 9;
    $args = array(
      'posts_per_page'=> $perpage,
      'post_type'   => $posttype,
      'post_status' => 'publish'
    );
    $projects = new WP_Query($args);
    if ( $projects->have_posts() ) {  ?>
    <div id="projectList">
      <div class="project-columns">
        <div class="flexwrap">
        <?php echo get_posttype_listing($posttype,$paged,$perpage,null); ?>
        </div>
        <?php  
        $total_pages = $projects->max_num_pages;
        $totalpost = $projects->found_posts; 
        if ($total_pages > 1){ ?>
        <div class="loadmore">
          <span class="moretxt">Load More</span>
          <a href="javascript:void(0)" id="loadMoreBtn" data-pg="<?php echo $paged+1 ?>" data-perpage="<?php echo $perpage ?>" data-posttype="<?php echo $posttype ?>" data-total="<?php echo $total_pages ?>" class="plusBtn"><span></span></a>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php } ?>

	</main>
</div>
<?php
get_footer();
