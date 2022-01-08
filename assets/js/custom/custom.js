/**
 *	Custom jQuery Scripts
 *	Date Modified: 09.03.2021
 *	Developed by: Lisa DeBona
 */

jQuery(document).ready(function ($) {

  /* Slideshow */
  var swiper = new Swiper('#slideshow', {
    effect: 'fade', /* "slide", "fade", "cube", "coverflow" or "flip" */
    loop: true,
    noSwiping: false,
    simulateTouch : false,
    speed: 1000,
    autoplay: {
      delay: 4000,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

  swiper.on('slideChangeTransitionStart', function () {
    // var slideNum = $(".swiper-slide-active").attr("data-slide");
    // $(".slideCaption").removeClass('active');
    // $(".slideCaption."+slideNum).addClass('active');
  });

}); 