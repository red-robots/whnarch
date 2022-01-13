<?php
get_header();
$ob = get_queried_object();
$taxonomy = $ob->taxonomy;
$current_term_id = $ob->term_id;
$term_name = $ob->name;
?>

<div id="primary" class="content-area taxonomy-page">
  <main id="main" class="site-main wrapper">

  <header class="entry-title" style="display:none"><h1 class="page-title"><?php echo $term_name; ?></h1></header>

	 <?php
    $current_page = get_permalink();
    include( locate_template('parts/project-categories-breadcrumb.php') );
    $placeholder = THEMEURI . 'images/rectangle-lg.png';
    $paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
    $posttype = 'projects';
    $perpage = (get_field("projects_perpage","option")) ? get_field("projects_perpage","option") : 9;
    $args = array(
      'posts_per_page'=> $perpage,
      'post_type'   => $posttype,
      'post_status' => 'publish',
      'tax_query'       => array( 
        array(
          'taxonomy'    => $taxonomy,
          'field'       => 'term_id',
          'terms'       => array( $current_term_id ),
        )
      )
    );
    $tax['taxonomy'] = $taxonomy;
    $tax['term_id'] = $current_term_id;
    $projects = new WP_Query($args);
    if ( $projects->have_posts() ) {  ?>
    <div id="projectList">
      <div class="project-columns">
        <div class="flexwrap">
          <?php echo get_posttype_listing($posttype,$paged,$perpage,$tax); ?>
        </div>
        <?php  
        $total_pages = $projects->max_num_pages;
        $totalpost = $projects->found_posts; 
        if ($total_pages > 1){ ?>
        <div class="loadmore">
          <span class="moretxt">Load More</span>
          <a href="javascript:void(0)" id="loadMoreBtn" data-pg="<?php echo $paged+1 ?>" data-perpage="<?php echo $perpage ?>" data-posttype="<?php echo $posttype ?>" data-total="<?php echo $total_pages ?>" data-taxonomy="<?php echo $taxonomy ?>" data-termid="<?php echo $current_term_id ?>" class="plusBtn"><span></span></a>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php } ?>

	</main>
</div>

<?php
get_footer();
