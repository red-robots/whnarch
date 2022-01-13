<?php $effect = ( isset($animation) && $animation ) ? ' '.$animation : ''; ?>
<div class="box<?php echo $effect ?>">
  <a href="<?php echo $pagelink ?>" class="link <?php echo $has_image ?>">
    <?php if ($thumbnail) { ?>
    <span class="image" style="background-image:url('<?php echo $thumbnail['url'] ?>')"></span> 
    <?php } ?>
    <img src="<?php echo $placeholder ?>" alt="" aria-hidden="true">
    <span class="view"><span class="plus"></span></span>
  </a>
  <p class="project-name"><a href="<?php echo $pagelink ?>"><?php the_title(); ?></a></p>
</div>