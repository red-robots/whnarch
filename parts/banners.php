<?php  if( is_front_page() || is_home() ) { 
  $banners = get_field("banners"); 
  $count = ($banners) ? count($banners) : 0;
  $slidesId = ($count>1) ? 'slideshow':'static-banner';
  ?>
  <?php if ($banners) { ?>
  <div class="slides-wrapper">
    <div class="slides-inner">
      <div id="<?php echo $slidesId ?>" class="swiper-container">
        <div class="swiper-wrapper">
        <?php $j=1; foreach ($banners as $b) { 
          $image = $b['image'];
          $caption = $b['caption'];
          if($image) { ?>
          <div class="swiper-slide " data-slide="slide<?php echo $j?>">
            <div class="slideImage" style="background-image:url('<?php echo $image['url'] ?>')"></div>
            <?php if ($caption) { ?>
            <div class="slideCaption"><div class="wrap"><div class="text"><?php echo $caption ?></div></div></div> 
            <?php } ?>
          </div>
          <?php $j++; } ?>
        <?php } ?>
        </div>
      </div>
      <?php if ($count>1) { ?>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      <?php } ?>
    </div>
    <div class="bottom-middle-line"><span class="animated fadeInUp"></span></div>
  </div>
  <?php } ?>
<?php } else { ?>

  <?php  
  $banner_bottom_text = get_field('banner_bottom_text');
  if( $banner_image = get_field("banner_image") ) { 
    $banner_title = get_field('banner_title');
    $banner_text = get_field('banner_text');
    $has_text = ($banner_title && $banner_text) ? ' has-text':'';
    ?>
  <div class="subpage-banner<?php echo $has_text ?>">
    <div class="image" style="background-image:url('<?php echo $banner_image['url'] ?>')"></div>
    <img src="<?php echo THEMEURI ?>images/map-resizer.png" alt="" aria-hidden="true" class="resizer" />
    <?php if ($banner_title || $banner_text) { ?>
    <div class="banner-caption animated fadeInUp">
      <div class="inner">
        <div class="wrap">
          <?php if ($banner_title) { ?>
           <h2 class="banner-title"><?php echo $banner_title ?></h2> 
          <?php } ?>
          <?php if ($banner_text) { ?>
           <div class="banner-text"><?php echo $banner_text ?></div> 
          <?php } ?>
        </div>
      </div>
    </div> 
    <?php } ?>
  </div>
  <?php } ?>

  <?php if ($banner_bottom_text) { ?>
  <div class="banner-bottom-text">
    <div class="wrapper">
      <?php echo $banner_bottom_text ?>
    </div>
  </div>
  <?php } ?>

  <style type="text/css">
    header.entry-title {display:none;} 
  </style>
<?php } ?>

