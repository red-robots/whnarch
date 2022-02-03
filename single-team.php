<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

$placeholder = THEMEURI . 'images/rectangle.png';
get_header(); ?>

<div id="primary" class="content-area-full content-default staff-details-page">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
      <?php
      $photo_large = get_field("photo_large");
      $top_class = ($photo_large) ? 'half':'full';
      $jobtitle = get_field("jobtitle");
      ?>

      <div class="section-name <?php echo $top_class ?>">
        <?php if ($photo_large) { ?>
        <div class="photo">
          <span style="background-image:url('<?php echo $photo_large['url'] ?>')"></span>
          <img src="<?php echo $placeholder ?>" class="resizer" alt="" aria-hidden="true" />
        </div> 
        <?php } ?>

        <div class="info">
          <div class="inner">
            <div class="titlediv">
              <h1 class="page-title"><?php the_title(); ?></h1>
              <?php if ($jobtitle) { ?>
              <div class="jobtitle"><?php echo $jobtitle ?></div> 
              <?php } ?>
            </div>
            
            <?php if( $education = get_field("education") ) { ?>
            <div class="educations">
              <?php foreach ($education as $e) { ?>
                <div class="skill">
                  <?php if ($e['heading']) { ?>
                  <div class="t1"><?php echo $e['heading'] ?></div>
                  <?php } ?>
                  <?php if ($e['info']) { ?>
                  <div class="t2"><?php echo $e['info'] ?></div>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>

      <?php if ( get_the_content() ) { ?>
	    <div class="section-bio full">
        <div class="wrapper">
          <?php the_content(); ?>
        </div>
      </div>
      <?php } ?>


		<?php endwhile; ?>


    <?php
    // POST NAVIGATION
    $posttype = 'team';
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


        echo '<a href="'.get_site_url().'/team/" class="all"><span class="alltxt"></span></a>';


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
