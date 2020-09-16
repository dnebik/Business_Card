/*======= AccessForm *=======*/

// var help_block = $(".help-block");
//
// for (let i = 0; i < help_block['length']; i++) {
//     if (help_block[i]['innerHTML'] == "") {
//         help_block.get(i).remove();
//     }
//
// }

jQuery(document).ready(function($) {
    /*======= Skillset *=======*/
    $('.level-bar-inner').css('width', '0');
    $(window).on('load', function() {
        $('.level-bar-inner').each(function() {
            var itemWidth = $(this).data('level');
            $(this).animate({
                width: itemWidth
            }, 800);
        });
    });
});

$(window).on('resize', function() {
    $('.tHead-space').width($(window).width() - 950);
    console.log($(window).width());
})