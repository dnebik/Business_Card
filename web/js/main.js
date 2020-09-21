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

var editor = new MediumEditor('.textarea', {
    targetBlank: true,
    sticky: true,
    toolbar: {
        buttons: ['bold', 'italic', 'underline', 'anchor'],
        diffLeft: 25,
        diffTop: 10,
    },
    extensions: {
        'imageDragging': {}
    },
    placeholder: {
        text: 'Введите свое описание.',
        hideOnClick: true
    }
});
var el = $('.medium-editor-element');
el[0].hidden = false;


$(window).on('resize', function() {
    $('.tHead-space').width($(window).width() - 950);
    console.log($(window).width());
});



// Добавление блока
$('.block-inputs').on('click', '.add_b', function(e) {
    e.preventDefault();
    let $parent = $(this).parent();
    let $clone = $parent.clone();
    $parent.after($clone);
    $clone.find('input').val('').focus();
});

// Удаление блока
$('.block-inputs').on('click', '.del_b', function(e) {
    e.preventDefault();
    let $parent = $(this).parent();
    // Предотвращение удаления единственного блока
    if ($parent.siblings().length) {
        $parent.remove();
    }
});

