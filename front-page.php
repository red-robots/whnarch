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

        <?php  
        $intro_text = get_field("main_text");
        if($intro_text) { ?>
        <div class="entry-content">
          <div class="wrapper">
            <div class="intro text-center">
              <?php echo anti_email_spam($intro_text); ?>
            </div>
          </div>
        </div>
        <?php } ?>

        <?php  
        /* RECENT PROJECTS */
        $recent_projects = get_field("featured_projects");
        $rp_title = get_field("rw_section_title");
        $rp_button = get_field("rw_button");
        $rp_btnLink = ( isset($rp_button['url']) && $rp_button['url'] ) ? $rp_button['url'] : '';
        $rp_btnText = ( isset($rp_button['title']) && $rp_button['title'] ) ? $rp_button['title'] : '';
        $rp_btnTarget = ( isset($rp_button['target']) && $rp_button['target'] ) ? $rp_button['target'] : '_self';
        $placeholder = THEMEURI . 'images/rectangle-lg.png';
        if($recent_projects) { ?>
        <section class="recent-projects">
          <div class="wrapper">
            <?php if ($rp_title) { ?>
            <h2 class="section-title"><?php echo $rp_title ?></h2> 
            <?php } ?>
            <div class="project-columns">
              <div class="flexwrap">
              <?php foreach ($recent_projects as $p) {
                $id = $p->ID;
                $pagelink = get_permalink($id);
                $thumbnail = get_field("thumbnail",$id);
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
                </div>
              <?php } ?>
              </div>
            </div>
            <?php if ($rp_btnLink && $rp_btnText) { ?>
            <div class="more-button">
              <a href="<?php echo $rp_btnLink ?>" target="<?php echo $rp_btnTarget ?>" class="more"><span><?php echo $rp_btnText ?></span><i class="arrow"></i></a>
            </div>
            <?php } ?>
          </div>
        </section>
        <?php } ?>

      <?php endwhile;  ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
get_footer();
