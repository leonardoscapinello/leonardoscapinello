<?php
require_once("./src/properties/index.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conteúdo sobre Migração ao Digital - Leonardo Scapinello</title>
    <link href="<?= $static->getFileLocation("stylesheet.min.css") ?>" type="text/css" rel="stylesheet">
    <link href="<?= $static->getFileLocation("owl.carousel.css") ?>" type="text/css" rel="stylesheet">
    <link href="<?= $static->getFileLocation("owl.theme.default.css") ?>" type="text/css" rel="stylesheet">
    <?= $socialAnalytics->getGoogleAnalyticsScript_Head() ?>
    <?= $socialAnalytics->getGoogleTagManagerScript_Head() ?>
    <?= $socialAnalytics->getFacebookPixel_Head("website") ?>
</head>
<body>
<div id="wrapper">
    <?php require_once(DIRNAME . "../components/header-featured.php") ?>
    <?php require_once(DIRNAME . "../components/blog-featured-widget.php") ?>
    <?php if ($session->isLogged()) { ?>
        <?php require_once(DIRNAME . "../components/blog-categories-widgets.php") ?>
        <?php require_once(DIRNAME . "../components/series-widget.php") ?>
    <?php } else { ?>
        <?php require_once(DIRNAME . "../components/newsletter.php") ?>
        <?php require_once(DIRNAME . "../components/about-me.php") ?>
        <?php require_once(DIRNAME . "../components/cases.php") ?>
    <?php } ?>

    <?php require_once(DIRNAME . "../components/footer.php") ?>
</div>


<link rel="stylesheet" href="https://cdn.plyr.io/3.5.10/plyr.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="./static/javascript/owl.carousel.min.js"></script>
<script src="https://cdn.plyr.io/3.5.10/plyr.js"></script>
<script type="text/javascript">
    const players = Array.from(document.querySelectorAll('.ls-player')).map(p => new Plyr(p));
</script>
<script type="text/javascript">
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
    });
</script>
</body>
</html>