<?php
/**
 * Template Name: Contact
 *
 */
$mapResizer = THEMEURI . 'images/map-resizer.png';
get_header(); ?>
<div id="primary" class="content-area default-template projects-page parent-page">
	<main id="main" class="site-main">
		<?php while ( have_posts() ) : the_post(); ?>

      <?php /* MAP */ ?>
      <div class="map-wrapper">
        <?php if ( $map = get_field("googleMap") ) { ?>
        <div class="map-cover"></div>
        <div class="map-iframe"><?php echo $map ?></div> 
        <?php } ?>
        <img src="<?php echo $mapResizer ?>" alt="" aria-hidden="true" class="helper"/>
      </div>

      <header class="entry-title" style="display:none"><h1 class="page-title"><?php the_title(); ?></h1></header>

      <?php  
        $formText = get_field("contact_form_text");
        $contact = get_field("contact");
        $cTitle = ( isset($contact['heading']) && $contact['heading'] ) ? $contact['heading'] : '';
        $cText = ( isset($contact['text']) && $contact['text'] ) ? $contact['text'] : '';
        $gravity_form = get_field("gravity_form");
        $contactForm = '';
        $has2columns = (($formText || $cText) && $contactForm) ? 'half':'full';
        if($gravity_form) {
          if( do_shortcode('[gravityform id="'.$gravity_form.'" title="false" description="false" ajax="true"]') ) {
            $contactForm = do_shortcode('[gravityform id="'.$gravity_form.'" title="false" description="false" ajax="true"]');
          }
        }
      ?>

      <?php if (get_the_content()) { ?>
      <section class="entry-content"><?php the_content(); ?></section>
      <?php } ?>

      <?php if (($formText || $cText) || $contactForm) { ?>
      <div class="form-wrapper <?php echo $has2columns ?>">
        <div class="wrapper">
          <div class="flexwrap">
            <?php if ($formText || $cText) { ?>
            <div class="info left">
              <?php if ($formText) { ?>
               <h2 class="title-large"><?php echo $formText ?></h2> 
              <?php } ?>
              <?php if ($cText) { ?>
               <div class="info">
                 <?php if ($cTitle) { ?>
                  <div class="small-title"><?php echo $cTitle ?></div> 
                 <?php } ?>

                 <?php if ($cText) { ?>
                  <div class="contact-info"><?php echo $cText ?></div> 
                 <?php } ?>
               </div>
              <?php } ?>
            </div>
            <?php } ?>

            <?php if ($contactForm) { ?>
            <div class="info right">
              <div class="contact-form">
                <?php echo $contactForm; ?>
                <div class="custom-button">
                  <a href="#" class="gform_button submit-button" id="submitFormBtn"><span>Submit</span><i class="arrow"></i></a>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>

		<?php endwhile; ?>
	</main>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
  $("#submitFormBtn").on("click",function(e){
    e.preventDefault();
    $(".contact-form form").trigger("submit");
  });
});
</script>
<?php
get_footer();
