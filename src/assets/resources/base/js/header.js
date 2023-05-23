//   EFFETTO SHRINK HEADER
$(window).ready(function(){
  $('#headerFixed').css('position','fixed');
  var marginHeader = $('#headerFixed').outerHeight();
  $('#bk-page').css('margin-top',marginHeader);

  $('#headerContent').css('position','fixed');
  var marginHeader = $('#headerContent').outerHeight();
  $('#bk-page').css('margin-top',marginHeader);
 
});

$(window).on("scroll", function () {
  var headerHeight = $('#headerContent').outerHeight();

  if ($(window).scrollTop() > $('#headerContent').outerHeight()) { 
    $("body").addClass("shrink");
    $('#bk-page > #sidebarLeftRedattore > .sidebar-nav.affix-top').css('top', Number(headerHeight) + (Number(20)));

  } else {
    $("body").removeClass("shrink");
    var marginHeader = $('#headerContent').outerHeight();
    $('#bk-page').css('margin-top',marginHeader);
    
    
  }
  if ($(window).scrollTop() > $('#headerFixed').outerHeight()) { 
    
    $("body").addClass("shrink");
    $('#bk-page > #sidebarLeftRedattore > .sidebar-nav.affix-top').css('top', Number(headerHeight) + (Number(20)));

  } else {
    $("body").removeClass("shrink");
    $('#bk-page > #sidebarLeftRedattore > .sidebar-nav.affix-top').css('top', Number(headerHeight) + (Number(20)));

  
  } 
});
// PUSH UP ASSISTANNCE
$(window).on("scroll", function () {
  if
    ($(window).scrollTop() >= 99) {
    $(".bi-assistance").addClass("push-up");
  }
  else {
    $(".bi-assistance").removeClass("push-up");
  }
});

// PUSH UP GUIDE
$(window).on("scroll", function () {
  if
    ($(window).scrollTop() >= 99) {
    $(".bi-guide").addClass("push-up");
  }
  else {
    $(".bi-guide").removeClass("push-up");
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


//TOGGLE SIDEBAR REDATTORE
function toggleSidebar() {
  var element = document.getElementById("sidebarLeftRedattore");
  element.classList.toggle("sidebar-small");
}