<?php
require_once("./src/properties/index.php");
$p = get_request("p");
$home = false;
if ($p === "index.php") $home = !$home;

$page = new Pages($p);



?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $page->getTitle() !== null ? $page->getTitle() . " - " : "" ?>Leonardo Scapinello</title>
    <link href="<?= $static->getFileLocation("stylesheet.min.css") ?>" type="text/css" rel="stylesheet">
    <link href="<?= $static->getFileLocation("owl.carousel.css") ?>" type="text/css" rel="stylesheet">
    <link href="<?= $static->getFileLocation("owl.theme.default.css") ?>" type="text/css" rel="stylesheet">
    <?= $socialAnalytics->getGoogleAnalyticsScript_Head($page->getGoogleAnalyticsKey()) ?>
    <?= $socialAnalytics->getGoogleTagManagerScript_Head($page->getGoogleTagManagerKey()) ?>
    <?= $socialAnalytics->getFacebookPixel_Head($page->getFacebookPixelKey(), $page->getFacebookPixelTrackName()) ?>
</head>
<body>
<div id="wrapper">

    <?php
    if ($home) {
        require_once(DIRNAME . "../components/header-featured.php");
        require_once(DIRNAME . "../components/blog-featured-widget.php");
        if ($session->isLogged()) {
            require_once(DIRNAME . "../components/blog-categories-widgets.php");
            require_once(DIRNAME . "../components/series-widget.php");
        } else {
            require_once(DIRNAME . "../components/newsletter.php");
            require_once(DIRNAME . "../components/about-me.php");
            require_once(DIRNAME . "../components/cases.php");
        }
    } else {
        require_once(DIRNAME . "../components/header.php");
        echo "<div class=\"page-ctn\">";
        $page->getContent() ? require_once($page->getContent()) : "";
        echo "</div>";
    }

    require_once(DIRNAME . "../components/footer.php");
    ?>
</div>


<?php require_once(DIRNAME . "../components/footer-scripts.php") ?>
</body>
</html>