<?php
/**
 * Template Name: Team
 *
 */
get_header(); ?>
<div id="primary" class="content-area default-template projects-page parent-page">
	<main id="main" class="site-main">
		<?php while ( have_posts() ) : the_post(); ?>
      <div class="page-content wrapper">
        <header class="entry-title" style="display:none"><h1 class="page-title"><?php the_title(); ?></h1></header>
        <?php if (get_the_content()) { ?>
        <section class="entry-content"><?php the_content(); ?></section>
        <?php } ?>
      </div>
		<?php endwhile; ?>	

    <?php
    $resizer = THEMEURI . 'images/profile-resizer.png';
    $taxonomy = 'team-group';
    $groups = get_terms( array(
      'taxonomy' => $taxonomy,
      'hide_empty' => false,
    ));
    if($groups) { ?>

    <div class="teamList">
      <div class="wrapper">
        <?php foreach ($groups as $g) { 
          $args = array(
            'post_type'     =>'team',
            'post_status'   =>'publish',
            'posts_per_page'  => -1,
            'tax_query' => array(
              array(
                'taxonomy'  => $taxonomy, 
                'field'   => 'slug',
                'terms'   => array($g->slug) 
              )
            )
          );
          $entries = new WP_Query($args);
          if ($entries->have_posts()) { ?>
          <div class="group">
            <h2 class="subhead red-heading"><?php echo $g->name; ?></h2>
            <div class="entries">
              <?php while ($entries->have_posts()) : $entries->the_post();
              $photo = get_field('photo');
              $jobTitle =  get_field('jobtitle');
              $pagelink = get_permalink();
              ?>
              <div class="info">
                <a href="<?php echo $pagelink ?>" class="pagelink">
                  <?php if ($photo) { ?>
                  <span class="photo yes" style="background-image:url('<?php echo $photo['url'] ?>')">
                    <img src="<?php echo $resizer ?>" alt="" aria-hidden="false">
                  </span>
                  <?php } else { ?>
                  <span class="photo no">
                    <img src="<?php echo $resizer ?>" alt="" aria-hidden="false">
                  </span>
                  <?php } ?>
                  <div class="team-name">
                    <span class="name"><?php the_title(); ?></span>
                    <?php if ($jobTitle) { ?>
                    <span class="jobtitle"><?php echo $jobTitle ?></span>
                    <?php } ?>
                  </div>
                </a>
              </div>
              <?php endwhile; ?>
            </div>
          </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>

    <?php } ?>

	</main>
</div>
<?php
get_footer();
