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
    <?php require_once(DIRNAME . "../components/footer-scripts.php") ?>
</div>



<?php require_once(DIRNAME . "../components/footer-scripts.php") ?>
</body>
</html>