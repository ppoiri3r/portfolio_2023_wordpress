export function animateOnScroll() {
  let windowsize = $(window).width();

  // on page load 
  if(windowsize > 600) {
    scroll();
  } else if(windowsize <= 600) {
    // do nothing
  }

  // on window resize
  $(window).resize(function(e) {
    var windowSizeOnResize = $(window).width();
    if(windowSizeOnResize <= 600) {
      $('body').removeClass('scroll');
    } else if (windowSizeOnResize > 600) {
      scroll();
    }
   })

  function scroll() {
    let lastScrollTop = 0;
    $(window).scroll(function(event){
      let windowsize = $(window).width();
      if(windowsize > 600) {
        let st = $(this).scrollTop();
        if (st > lastScrollTop) {
          $('body').addClass('scroll');
        }
        if($(window).scrollTop() == 0) {
          $('body').removeClass('scroll');
        }
        lastScrollTop = st;
      } else {
        // do nothing;
      }
    });
  }
}