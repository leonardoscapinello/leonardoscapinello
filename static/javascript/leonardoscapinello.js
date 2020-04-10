const players = Array.from(document.querySelectorAll('.ls-player')).map(p => new Plyr(p));

function navigation() {
    $("#header-nav").slideToggle(500);
}

$(document).ready(function () {
    $('.blog-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        control: false,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            720: {
                items: 2,
                nav: false
            },
            1000: {
                items: 3,
                nav: false
            },
            1360: {
                items: 4,
                nav: false,
                loop: false
            },
            1680: {
                items: 5,
                nav: false,
                loop: false
            }
        }
    });
    $('.categories-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        control: false,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            720: {
                items: 2,
                nav: false
            },
            1000: {
                items: 3,
                nav: false
            },
            1360: {
                items: 4,
                nav: false,
                loop: false
            },
            1680: {
                items: 5,
                nav: false,
                loop: false
            }
        }
    });
    $('.cases-carousel').owlCarousel({
        loop: true,
        margin: 10,
        responsiveClass: true,
        control: false,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            480: {
                items: 2,
                nav: false
            },
            720: {
                items: 3,
                nav: false
            },
            1080: {
                items: 4,
                nav: false,
                loop: false
            },
            1360: {
                items: 5,
                nav: false,
                loop: false
            },
            1600: {
                items: 6,
                nav: false,
                loop: false
            },
        }
    });

    $(".phone_with_ddd").mask("(00) 00000-0000");
    $(".header-outer-size").css("height", ($(".header--company").outerHeight() - 6) + "px");

});


var typingTimer;
var doneTypingInterval = 700;
var $input = $('#q');

$input.on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
});
$input.on('keydown', function () {
    clearTimeout(typingTimer);
});

$(window).on("resize", function () {
    $(".header-outer-size").css("height", ($(".header--company").outerHeight() - 6) + "px");
});


function openSearch() {
    $input.val("");
    $("#load-search").html("<div class=\"result\"> <div class=\"post-title text center\"> <i class=\"far fa-robot\"></i> <p class=\"text center\"><span class=\"big-text\">Bip. Bip.</span><br /> É só você digitar o que está procurando (aqui em cima) e vou revirar alguns documentos, beleza?</p> </div> </div>");
    $("#search_modal").fadeIn(300);
    $("body").css("overflow", "hidden");
}

$(".close_smdl").on("click", function () {
    $("#search_modal").fadeOut(300);
    $("body").css("overflow", "initial");
});

function doneTyping() {
    let v = $input.val();
    if (v.length === 0) {
        $("#search_modal").fadeOut(300);
    } else if (v.length > 0) {
        search(v);
    }
}

function search(str) {
    $.ajax({
        data: {q: str},
        type: 'GET',
        url: SERVER + "/06a943c59f33a34bb5924aaf72cd2995",
        cache: false,
        crossDomain: true,
        success: function (data) {
            $("#load-search").fadeOut(200).html(data).fadeIn(300);
        }
    });
}