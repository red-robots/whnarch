/**
 *	Custom jQuery Scripts
 *	Date Modified: 09.03.2021
 *	Developed by: Lisa DeBona
 */

jQuery(document).ready(function ($) {

  $("#menutoggle").on("click",function(e){
    e.preventDefault();
    $('body').toggleClass('mobile-menu-open');
    $('#site-navigation').toggleClass('open fadeIn');
    $(this).toggleClass('open');
  });

  var i = 2;
  $("#primary-menu > li > a").each(function(k){
    i++;
    var num = i/10;
    $(this).css({
      'animation-duration':num+'s'
    });
  });

  $("#primary-menu > li.menu-item-has-children").each(function(k){
    var mobileDropdown = '<span class="menu-dropdown-btn"><i></i></span>';
    $(this).prepend(mobileDropdown);
  });

  $(document).on("click",".menu-dropdown-btn",function(){
    $(this).next().next().slideToggle();
  });

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

  /*SLICK CAROUSEL */
  $('#slick-carousel').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    centerMode: true,
    variableWidth: true
  });

  $(document).on("click","#slick-carousel .slick-slide",function(e) {
    e.preventDefault();
    if( $(this).prev().hasClass('slick-current') ) {
      $("button.slick-next").trigger("click");
    }
    else if( $(this).next().hasClass('slick-current') ) {
      $("button.slick-prev").trigger("click");
    }
  });

  $(".custom-slick-nav").on("click",function(e){
    e.preventDefault();
    var slickBtn = $(this).attr("data-slickbtn");
    $(slickBtn).trigger("click");
  });


  /* AJAX PAGINATION */
  $(document).on("click","#loadMoreBtn",function(e){
    e.preventDefault();
    var target = $(this);
    var pagenum = target.attr("data-pg");
    var nextpage = parseInt(pagenum)+1;
    var total = target.attr("data-total");
    var current_taxonomy = ( typeof target.attr("data-taxonomy")!='undefined' ) ? target.attr("data-taxonomy") : '';
    var current_term_id = ( typeof target.attr("data-termid")!='undefined' ) ? target.attr("data-termid") : '';
    $.ajax({
      url : frontajax.ajaxurl,
      type : 'post',
      dataType : "json",
      data : {
        action : 'get_posttype_content',
        pg : pagenum,
        perpage : target.attr("data-perpage"),
        posttype : target.attr("data-posttype"),
        taxonomy : current_taxonomy,
        term_id : current_term_id
      },
      beforeSend:function(){
        $("#loaderdiv").show();
        target.attr("data-pg", nextpage);
        if(nextpage>total) {
          $('.loadmore').remove();
        } 
      },
      success : function( response ) {
        if(response.content) {
          $("#projectList .flexwrap").append(response.content);
        }
      },
      complete: function() {
        $("#loaderdiv").hide();
      }
    });
  });

}); 