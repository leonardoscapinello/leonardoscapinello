<?php
require_once("../src/properties/index.php");
require_once("../src/public/validate-admin.php");

$id = get_request("id");
$id_paragraph = get_request("paragraph");

$blog = new Blog($id);
$url = new URL();

$author = new Accounts($blog->getIdAuthor());
if ($id_paragraph === null) {
    header("location: " . $url->addQueryString(array("paragraph" => 0)));
    die;
}


?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>[RASCUNHO] <?= $blog->getPostTitle() ?> - Leonardo Scapinello</title>
    <link href="<?= $static->getFileLocation("stylesheet.min.css") ?>" type="text/css" rel="stylesheet">
    <link href="<?= $static->getFileLocation("owl.carousel.css") ?>" type="text/css" rel="stylesheet">
    <link href="<?= $static->getFileLocation("owl.theme.default.css") ?>" type="text/css" rel="stylesheet">
    <link href="<?= $static->getFileLocation("content-tools.min.css") ?>" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,500,700,900&display=swap"
          rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <?php require_once(DIRNAME . "../components/header.php") ?>
    <?php require_once(DIRNAME . "../components/blog-post-header-admin.php") ?>
    <?php require_once(DIRNAME . "../components/blog-post-content-admin.php") ?>
    <?php require_once(DIRNAME . "../components/footer.php") ?>
</div>

<?php require_once(DIRNAME . "../components/footer-scripts.php") ?>
</body>
</html>