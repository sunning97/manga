// Theme color settings
function store(name, val) {
    if (typeof (Storage) !== "undefined") {
        localStorage.setItem(name, val);
    } else {
        window.alert('Please use a modern browser to properly view this template!');
    }
}

$(document).ready(function () {
    var asset = $('#wrapper').data('asset');
    $("*[theme]").click(function (e) {
        e.preventDefault();
        var currentStyle = $(this).attr('theme');
        store('theme', currentStyle);
        $('#theme').attr({href: asset + '/'+currentStyle + '.css'})
    });

    var currentTheme = get('theme');
    if (currentTheme) {
        $('#theme').attr({href: asset +'/'+ currentTheme + '.css'});
    }
    // color selector
    $('#themecolors').on('click', 'a', function () {
        $('#themecolors li a').removeClass('working');
        $(this).addClass('working')
    });

});

function get(name) {
    return localStorage.getItem(name);
}

$(document).ready(function () {
    var asset = $('#wrapper').data('asset');
    $("*[theme]").click(function (e) {
        e.preventDefault();
        var currentStyle = $(this).attr('theme');
        store('theme', currentStyle);
        $('#theme').attr({href: asset+'/'+currentStyle +'.css'})
    });

    var currentTheme = get('theme');
    if (currentTheme) {
        $('#theme').attr({href: asset+ '/'+currentTheme + '.css'});
    }
    // color selector
    $('#themecolors').on('click', 'a', function () {
        $('#themecolors li a').removeClass('working');
        $(this).addClass('working')
    });
});
