<?php  
$banners = get_field("banners"); 
$count = ($banners) ? count($banners) : 0;
$slidesId = ($count>1) ? 'slideshow':'static-banner';
if( is_front_page() || is_home() ) { ?>
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
<?php } ?>

