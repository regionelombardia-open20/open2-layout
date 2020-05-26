$(window).on('load resize', function () {
    var heightFooterText = $(".footer-space").outerHeight();
    var heightFooterSponsor = $(".footer-sponsor-container").outerHeight();
    heightFooterText = (heightFooterText !== undefined) ? heightFooterText : 0;
    heightFooterSponsor = (heightFooterSponsor !== undefined) ? heightFooterSponsor : 0;
    var paddingBottom = heightFooterSponsor + heightFooterText;
    $("body").css('padding-bottom', paddingBottom);
})