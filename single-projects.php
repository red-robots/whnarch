<?php get_header(); ?>

<div id="primary" class="content-area-full content-default single-default-template <?php echo $has_banner ?>">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

      <?php include( locate_template('parts/carousel-slide.php') ); ?>

      <div class="single-page-content <?php echo (isset($galleries) && $galleries) ? 'hasGalleries':'NoGalleries'; ?>">
        <div class="wrapper">
          <header class="entry-title"><h1><?php the_title(); ?></h1></header>

          <?php  
          $client = get_field("client");
          $location = get_field("location");
          $has_left_col = ($client || $location) ? ' has-client-info':'';
          ?>
          
          <div class="project-full-info<?php echo $has_left_col ?>">
            <?php if ($client || $location) { ?>
            <div class="infocol left">
              <div class="text">
                <?php if ($client) { ?>
                <div class="info">
                  <span class="t1 f12">Client</span>
                  <span class="t2"><?php echo $client ?></span>
                </div>
                <?php } ?>
                <?php if ($location) { ?>
                <div class="info">
                  <span class="t1 f12">Location</span>
                  <span class="t2"><?php echo $location ?></span>
                </div> 
                <?php } ?>
              </div>
            </div> 
            <?php } ?>

            <div class="infocol right">
              <?php if (get_the_content()) { ?>
              <div class="entry-content"><?php the_content(); ?></div>
              <?php } ?>
            </div>
            
          </div>
          
          
        </div>
      </div>
      
    <?php endwhile; ?>


    <?php
    // POST NAVIGATION
    $posttype = get_post_type();
    $args = array(
      'posts_per_page'=> -1,
      'post_type'   => $posttype,
      'post_status' => 'publish'
    );
    $current_id = get_the_ID(); 

    // Reset offset
    $offset_next = 0;
    $offset_prev = 0;
    $totalpost = 0;

    // Calculate offset
    $query = new WP_Query($args);
    if ( $query->have_posts() ) : 
        $totalpost = $query->found_posts; 
        while ( $query->have_posts() ) : $query->the_post(); 
            $test_id = $post->ID;
            if ( $test_id == $current_id ) :
                // Set offset to current post
                $offset_next = $query->current_post + 1;
                $offset_prev = $query->current_post - 1;
            endif;
        endwhile; 
    endif;

    if($totalpost) { ?>
      <div class="post-type-navigation">

      <?php 
        /* PREV */
        $args1 = array(
          'posts_per_page'=> 1,
          'post_type'   => $posttype,
          'post_status' => 'offset_prev',
          'offset' => $offset_prev
        );

        // Display previous post in category
        $query1 = new WP_Query($args1);
        if ( $query1->have_posts() ) { 
          while ( $query1->have_posts() ) :  $query1->the_post(); 
            $thumbnail = get_field("thumbnail");
            if($thumbnail) {
              echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="prev"><span class="wrap"><span class="thumb" style="background-image:url('.$thumbnail['url'].')"></span><span class="txt"><i></i>Previous</span></span></a>';
            } else {
              echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="prev"><span class="wrap"><span class="txt"><i></i>Previous</span></span></a>';
            }
            
          endwhile; 
        }


        echo '<a href="'.get_site_url().'/projects/" class="all"><span class="alltxt"></span></a>';


        /* NEXT */
        $args2 = array(
          'posts_per_page'=> 1,
          'post_type'   => $posttype,
          'post_status' => 'publish',
          'offset' => $offset_next
        );

        // Display next post in category
        $query2 = new WP_Query($args2);
        if ( $query2->have_posts() ) { 
          while ( $query2->have_posts() ) :  $query2->the_post();
            $thumbnail = get_field("thumbnail"); 
            if($thumbnail) {
              echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="next"><span class="wrap"><span class="txt">Next<i></i></span><span class="thumb" style="background-image:url('.$thumbnail['url'].')"></span></span></a>';
            } else {
              echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="next"><span class="wrap"><span class="txt">Next<i></i></span></span></a>';
            }
          endwhile; 
        }
        ?>
      </div>
    <?php } ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
