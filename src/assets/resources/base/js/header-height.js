function calcMainContentMarginTop() {
    var marginHeader = $('#headerContent').outerHeight();
    var spaceFromHeaderToMainContent = '0';
    $('#mainContent > main').css('margin-top', Number(marginHeader) + Number(spaceFromHeaderToMainContent));
};

$(document).ready(function () {
    calcMainContentMarginTop();
});

$(window).on('resize',function () {
    calcMainContentMarginTop();
});