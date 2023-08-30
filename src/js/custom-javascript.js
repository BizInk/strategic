// Add your custom JS here.

jQuery(document).ready(function ($) {

  $(window).scroll(function () {
    var fixedtop = $('header');

    if ($(this).scrollTop() > 100) {
      fixedtop.addClass('fixed');
    } else {
      fixedtop.removeClass('fixed');
    } 
  });


  jQuery(".dropdown-menu .menu-item-has-children .dropdown-menu").before('<span class="arrow-icon"></span>');
  jQuery(".arrow-icon").click(function(){
    jQuery(this).toggleClass("arrow-flip");
    jQuery(this).next().toggleClass("show");
  });
  jQuery(".client-area-anchor").click(function(){
    jQuery(".client-area-cont").slideToggle();
  });
  jQuery(".navbar-toggler").click(function(){
    jQuery("body").toggleClass("menu-open");
  });

  if (window.matchMedia("(max-width:992px)").matches) {
    jQuery("header nav .btn").insertAfter(jQuery(".navbar-collapse > ul"));
  }
  
  jQuery(window).resize(function() {
    if (window.matchMedia("(max-width:992px)").matches) {
      jQuery("header nav .btn").insertAfter(jQuery(".navbar-collapse > ul"));
    }
  });
  
  jQuery(window).load(function() {
    if (window.matchMedia("(max-width:992px)").matches) {
      jQuery("header nav .btn").insertAfter(jQuery(".navbar-collapse > ul"));
    }
  });
  
  // logo-slider-start

  if (jQuery(document).find('.logo-slider').length > 0) {
    $('.logo-slider').slick({
      dots: true,
      arrows: false,
      infinite: false,
      speed: 300,
      slidesToShow: 6,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint:992,
          settings: {        
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: true,
          }
        },
        {
          breakpoint:767,
          settings: {              
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
          }
        }
      ]
    });
  }

  if (window.matchMedia("(min-width: 700px)").matches) {
    var numItems = $('.logo-slider .slick-track').children('.logo').length;
    if (numItems == 6) {
      $('.slick-dots').hide();
    }
  } 
  // logo-slider-end

 // team-slider-start

  $('.team-slider').slick({
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow:3,
    slidesToScroll: 3,
    responsive: [
      {
        breakpoint:992,
        settings: {        
          slidesToShow:2,
          slidesToScroll:2,
          arrows: false,
          dots: true,
        }
      },
      {
        breakpoint:767,
        settings: {              
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          dots: true,
        }
      }
    ]
  });

 
// team-slider-end

  // testimonial-slider-start
  if (jQuery(document).find('.testimonial-wrap').length > 0) {
    $('.testimonial-wrap').slick({
      dots: true,
      arrows: false,
      infinite: false,
      speed: 300,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint:992,
          settings: {        
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: true,
          }
        },
        {
          breakpoint:767,
          settings: {              
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
          }
        }
      ]
    });
  }
  
  if (window.matchMedia("(min-width: 992px)").matches) {
    var numItems1 = $('.testimonial-wrap .slick-track').children('.testimonial-card').length;
    if (numItems1 == 3) {
      $('.slick-dots').hide();
    }
  }

  // testimonial-slider-end


  // two-testimonial-slider-start
  if (jQuery(document).find('.two-col-testimonial-slider').length > 0) {
    $('.two-col-testimonial-slider').slick({
      dots: true,
      arrows: false,
      infinite: false,
      speed: 300,
      slidesToShow: 2,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint:992,
          settings: {        
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
          }
        }       
      ]
    });
  }

  // testimonial-slider-start
  if (jQuery(document).find('.testimonial-slider').length > 0) {
    $('.testimonial-slider').slick({
      dots: true,
      arrows: true,
      infinite: false,
      speed: 500,
      slidesToShow: 1,
      slidesToScroll: 1, 
      fade: true,
      cssEase: 'linear',
      responsive: [
        {
          breakpoint:1200,
          settings: {        
            arrows:false,
          }
        }       
      ]
    });
  }
 
  // two-testimonial-slider-end

  if (window.matchMedia('(max-width: 767px)').matches) {     

    jQuery('.filter-wrap .dropdown').click(function(){
      jQuery(this).next('ul').slideToggle();   
    });    
    jQuery(".filter-wrap ul li").on("click", function() {
    jQuery(this).parents("ul").slideUp(200);
    jQuery(this).parents(".filter-wrap").find(".dropdown").text($(this).text())
    });    
}
  
  if (jQuery(window).width() > 767) {
    jQuery(window).on('load resize', function(){
        var blogdetails = 0; //for the description section
        //Calculating the description new height
        jQuery('.blog-details h4').each(function(){       
            if(blogdetails < jQuery(this).outerHeight()){
                blogdetails = jQuery(this).outerHeight();
            }  
        });
        //Calculating the description new height
        jQuery('.blog-details h4').css({'min-height': blogdetails });
    });
  }

  // Counter START
  if (jQuery(document).find('#counter-box').length > 0) { 

  var a = 0;
  jQuery(window).scroll(function () {
    var oTop = jQuery("#counter-box").offset().top - window.innerHeight;
    if (a == 0 && jQuery(window).scrollTop() > oTop) {
      jQuery(".counter").each(function () {
        var $this = jQuery(this),
          countTo = $this.attr("data-number");
        jQuery({
          countNum: $this.text()
        }).animate({
          countNum: countTo
        }, {
          duration: 850,
          easing: "swing",
          step: function () {
            //$this.text(Math.ceil(this.countNum));
            $this.text(
              Math.ceil(this.countNum).toLocaleString("en")
            );
          },
          complete: function () {
            $this.text(
              Math.ceil(this.countNum).toLocaleString("en")
            );
          }
        });
      });
      a = 1;
    }
  });
}


});