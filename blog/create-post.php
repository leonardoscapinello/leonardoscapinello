<?php
require_once("../src/properties/index.php");
require_once("../src/public/validate-admin.php");

$title = get_request("post_title");
if (not_empty($title)) {
    $blog = new Blog();
    $post = $blog->register($title);

    if (notempty($post[0])) {
        header("location: ./edit-post?id=" . $post[0] . "&post=" . $post[1]);
    }

}

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Criar um novo Post - Leonardo Scapinello</title>
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

    <section>
        <div class="blog-post">
            <div class="post-content">

                <form>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-sm-12">
                                <div class="content-blog">

                                    <div class="content-paragraph">
                                        <h3 class="text black">Digite o título desse artigo.</h3>
                                        <div class="blog_input">
                                            <input type="text" name="post_title" value="" maxlength="120">
                                        </div>
                                        <div class="blog_input" align="center">
                                            <button class="btn btn--secondary">Criar Rascunho</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>

    <?php require_once(DIRNAME . "../components/footer.php") ?>
</div>


</body>
</html>