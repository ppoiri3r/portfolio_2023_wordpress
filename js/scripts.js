$(function(){

   // HANDLE SCROLL ANIMATION OF HEADING
   var windowsize = $(window).width();

   if(windowsize > 600) {
      scroll();
   } else if(windowsize <= 600) {
      // do nothing
   }

   $(window).resize(function(e) {
      var windowSizeOnResize = $(window).width();
      if(windowSizeOnResize <= 600) {
         $('body').removeClass('scroll');
      } else if (windowSizeOnResize > 600) {
         scroll();
      }
   })

   function scroll() {
      var lastScrollTop = 0;
      $(window).scroll(function(event){
         let windowsize = $(window).width();
         if(windowsize > 600) {
            var st = $(this).scrollTop();
            if (st > lastScrollTop) {
               $('body').addClass('scroll');
            }
            if($(window). scrollTop() == 0) {
   
               $('body').removeClass('scroll');
            }
            lastScrollTop = st;
         } else {
            // do nothing;
         }
      });
   }
   // END OF HANDLE SCROLL ANIMATION

	if($(window).width() > 980 ){
	     $(".menu-item-has-children > a").on("focus",function() {
	     	$(".active").removeClass("active");
	          $(this).parent().addClass("active");
	     });
  } else{
     $(".menu-item-has-children").on("click", function(){
        $(this).toggleClass('open').find(".sub-menu").slideToggle();
     })
  }

  $(".menu-button").on("click", function(){
     $(this).toggleClass("open");
     $(".menu").slideToggle();
  })

//   Resize function to close the mobile menu. Change MENU CONTAINER to navigation container of the theme
  var dwidth = $(window).width();

  $(window).on('resize', function() {
   if($(window).width() > 1200) {
      $(".menu ul").css('display', 'flex');
     } else {
      var wwidth = $(window).width();
      if(dwidth!==wwidth){
         dwidth = $(window).width();
         $(".menu ul").css('display', 'none');
         $('.menu-button').removeClass('open');
      }
     }
  });


// IE Check
   if (navigator.appName == 'Microsoft Internet Explorer' ||  !!(navigator.userAgent.match(/Trident/) || navigator.userAgent.match(/rv:11/)) || (typeof $.browser !== "undefined" && $.browser.msie == 1)) {
      $('body').addClass('IE');
   }



});