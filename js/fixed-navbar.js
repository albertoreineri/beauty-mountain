//Fixed Navbar

// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if ($(window).width() < 992) {
    /*
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
      document.getElementById("top-container").style.maxWidth = "100%";
      document.getElementById("navbar").setAttribute('style', 'background-color:rgba(30, 36, 42, 0.4) !important');
    } else {
      document.getElementById("top-container").style.maxWidth = "";
      document.getElementById("navbar").setAttribute('style', 'background-color:transparent !important');
    }  */
  }
  else {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
      document.getElementById("top-container").style.maxWidth = "100%";
      document.getElementById("navbar").setAttribute('style', 'background-color:rgba(30, 36, 42, 0.4) !important');
    } else {
      document.getElementById("top-container").style.maxWidth = "";
      document.getElementById("navbar").setAttribute('style', 'background-color:transparent !important');
    }  
  }
  
}

//Button to top
if ($('#backontop').length) {
  var scrollTrigger = 100, // px
      backToTop = function () {
          var scrollTop = $(window).scrollTop();
          if (scrollTop > scrollTrigger) {
              $('#backontop').addClass('show');
          } else {
              $('#backontop').removeClass('show');
          }
      };
  backToTop();
  $(window).on('scroll', function () {
      backToTop();
  });
  $('#backontop').on('click', function (e) {
      e.preventDefault();
      $('html,body').animate({
          scrollTop: 0
      }, 700);
  });
}
