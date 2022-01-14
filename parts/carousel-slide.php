<?php $galleries = get_field('galleries'); ?>
<?php if ($galleries) { $count = count($galleries); ?>
  <div class="carousel-container">
    <div id="slick-carousel" class="carousel-inner">
      <?php $j=1; foreach ($galleries as $img) { ?>
        <div class="slick-slide swipeImg<?php echo ($j==1) ? ' slick-current slick-active slick-center':''?>">
          <div class="slick-inner">
            <figure class="image-cover" style="background-image:url('<?php echo $img['url']; ?>')"></figure>
            <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['title']; ?>" />
          </div>
        </div>
      <?php $j++; } ?>
    </div>
    <?php if ($count>1) { ?>
    <div class="custom-slick-arrow">
      <div class="wrap">
        <a href="javascript:void(0)" class="custom-slick-nav" data-slickbtn=".slick-prev" id="custom-slick-prev"><span>Previous</span></a>
        <a href="javascript:void(0)" class="custom-slick-nav" data-slickbtn=".slick-next" id="custom-slick-next"><span>Next</span></a>
      </div>
    </div>
    <?php } ?>
    <img src="<?php echo THEMEURI . 'images/resizer.png' ?>" alt="" class="resizer" />
  </div>
<?php } ?>