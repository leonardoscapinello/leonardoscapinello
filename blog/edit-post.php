<?php
require_once("../src/properties/index.php");
require_once("../src/public/validate-admin.php");

$id = get_request("id");
$blog = new Blog($id);

$author = new Accounts($blog->getIdAuthor());

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

<link rel="stylesheet" href="<?= $static->getFileLocation("plyr.css") ?>"/>
<script src="<?= $static->getJSFileLocation("jquery.min.js") ?>"></script>
<script src="<?= $static->getJSFileLocation("plyr.js") ?>"></script>
<script type="text/javascript">
    const players = Array.from(document.querySelectorAll('.ls-player')).map(p => new Plyr(p));
</script>

<?php require_once(DIRNAME . "../components/footer-scripts.php") ?>
</body>
</html>