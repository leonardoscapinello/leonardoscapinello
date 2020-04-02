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


    $(".header-outer-size").css("height", ($(".header--company").outerHeight() - 6) + "px");

});


$(window).on("resize", function () {
    $(".header-outer-size").css("height", ($(".header--company").outerHeight() - 6) + "px");
});
