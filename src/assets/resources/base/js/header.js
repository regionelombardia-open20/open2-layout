//   EFFETTO SHRINK HEADER
$(document).ready(function(){
  $('#headerFixed').css('position','fixed');
  var marginHeader = $('#headerFixed').outerHeight();
$('#bk-page').css('margin-top',marginHeader);
});

$(document).on("scroll", function () {
  if ($(document).scrollTop() > $('#headerFixed').outerHeight()) { 
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

// MARGIN TOP bkPage
function calcMainContentMarginTop() {
  var marginHeader = $('#headerContent').outerHeight();
  var spaceFromHeaderToMainContent = '0';
  $('#bk-page').css('margin-top', Number(marginHeader) + Number(spaceFromHeaderToMainContent));
};

$(document).ready(function () {
  calcMainContentMarginTop();
});

$(window).on('resize',function () {
  calcMainContentMarginTop();
});