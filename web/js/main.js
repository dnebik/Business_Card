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
    // console.log($(window).width());
});



// Добавление блока
$('.block-inputs').on('click', '.add_b', function(e) {
    e.preventDefault();
    let $parent = $(this).parent();


    let input_name = $parent[0]['firstElementChild']['firstElementChild']['attributes']['name']['value'];
    var num = parseInt(input_name.replaceAll(/([A-Z]|[a-z]|\[|])/g, ''));

    let $clone = $parent.clone();
    $parent.after($clone);


    //Замена всех индефикаторов
    var foo = $clone[0]['children'][0]['classList']['value'];
    $clone[0]['children'][0]['classList']['value'] = foo.replace(num, num + 1);
    foo = $clone[0]['children'][1]['classList']['value'];
    $clone[0]['children'][1]['classList']['value'] = foo.replace(num, num + 1);
    foo = $clone[0]['children'][0]['children'][0]['attributes']['id']['value'];
    $clone[0]['children'][0]['children'][0]['attributes']['id']['value'] = foo.replace(num, num + 1);
    foo = $clone[0]['children'][1]['children'][0]['attributes']['id']['value'];
    $clone[0]['children'][1]['children'][0]['attributes']['id']['value'] = foo.replace(num, num + 1);
    foo = $clone[0]['children'][0]['children'][0]['attributes']['name']['value'];
    $clone[0]['children'][0]['children'][0]['attributes']['name']['value'] = foo.replace(num, num + 1);
    foo = $clone[0]['children'][1]['children'][0]['attributes']['name']['value'];
    $clone[0]['children'][1]['children'][0]['attributes']['name']['value'] = foo.replace(num, num + 1);
    //Конец замены

    $clone.find('select').val(0);
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

