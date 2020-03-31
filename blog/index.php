<?php
require_once("../src/properties/index.php");

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
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,500,700,900&display=swap"
          rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <?php require_once(DIRNAME . "../components/header.php") ?>
    <?php //require_once(DIRNAME . "../components/blog-post-header.php") ?>
    <?php //require_once(DIRNAME . "../components/blog-post-content.php") ?>
    <?php require_once(DIRNAME . "../components/footer.php") ?>
</div>


<link rel="stylesheet" href="<?= $static->getFileLocation("plyr.css") ?>"/>
<script src="<?= $static->getJSFileLocation("jquery.min.js") ?>"></script>
<script src="<?= $static->getJSFileLocation("plyr.js") ?>"></script>
<script type="text/javascript">
    const players = Array.from(document.querySelectorAll('.ls-player')).map(p => new Plyr(p));
</script>
</body>
</html>