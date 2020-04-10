<?php
require_once("../src/properties/index.php");
$id = get_request("id");
$blog = new Blog($id);
$author = new Accounts($blog->getIdAuthor());

$title = get_request("title");
$real_title = $blog->getPostURL(true);

if ($title !== $real_title) {
    header("location: " . $blog->getPostURL());
    die;
}

$canonial = $blog->getPostURL();
$description = $blog->getDescription();
$keywords = $blog->getKeywords();
$pagename = $blog->getPostTitle() . " | " . SITE_NAME;
$author = $blog->getAuthor();
$company = "Leonardo Scapinello";

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width = 320; initial-scale=1.0; maximum-scale=1.0; user-scalable=no; target-densitydpi=160dpi">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $pagename ?></title>
    <link rel="canonical" href="<?= $canonial ?>"/>
    <meta name="keywords"
          content="<?= $keywords ?>"/>
    <meta name="description"
          content="<?= $description ?>"/>
    <meta name="copyright" content="<?= $company ?>">
    <meta name="robots" content="index,follow"/>
    <meta name="url" content="<?= $canonial ?>">
    <meta name="identifier-URL" content="<?= $canonial ?>">
    <meta name="pagename" content="<?= $pagename ?>">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="shortcut icon" type="image/ico" href="./favicon.ico"/>

    <meta name="apple-mobile-web-app-title"
          content="<?= $pagename ?>"> <!-- New in iOS6 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">

    <meta property="og:title" content="<?= $pagename ?>"/>
    <meta property="og:url" content="<?= $canonial ?>"/>

    <meta name="og:title" content="<?= $pagename ?>"/>
    <meta name="og:type" content="website"/>
    <meta name="og:url" content="<?= $canonial ?>"/>
    <meta name="og:image" content="./thumb.png"/>
    <meta name="og:site_name" content="<?= $pagename ?>"/>
    <meta name="og:description"
          content="<?= $description ?>"/>


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
    <?php require_once(DIRNAME . "../components/blog-post-header-public.php") ?>
    <?php require_once(DIRNAME . "../components/blog-post-content-public.php") ?>
    <?php require_once(DIRNAME . "../components/footer.php") ?>
</div>


<?php require_once(DIRNAME . "../components/footer-scripts.php") ?>
</body>
</html>