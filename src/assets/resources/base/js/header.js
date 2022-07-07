//   EFFETTO SHRINK HEADER
$(document).on("scroll", function () {
  if ($(document).scrollTop() > ($('body > .container-header').outerHeight() + $('body > .container-logo').outerHeight())) {
    $("body").addClass("shrink");
  } else {
    $("body").removeClass("shrink");
  } 
});
// PUSH UP ASSISTANNCE
$(document).on("scroll", function () {
  if
    ($(document).scrollTop() >= 99) {
    $(".bi-assistance").addClass("push-up");
  }
  else {
    $(".bi-assistance").removeClass("push-up");
  }
});

// BACK TO TOP

$(function() {
  const $backToTopElements = $('a[data-attribute*="back-to-top"]')
  $(window).on('scroll', function() {
    $backToTopElements.toggleClass(
      'back-to-top-show',
      $backToTopElements.length && $(this).scrollTop() >= 100
    )
  })

  $backToTopElements.on('click', function() {
    $('body,html').animate({ scrollTop: 0 }, 800)
  })
})