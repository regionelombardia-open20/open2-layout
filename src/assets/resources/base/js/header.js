//   EFFETTO SHRINK HEADER
$(document).on("scroll", function () {
  if ($(document).scrollTop() > ($('body > .container-header').outerHeight() + $('body > .container-logo').outerHeight())) {
    $("body").addClass("shrink");
  } else {
    $("body").removeClass("shrink");
  } 
});