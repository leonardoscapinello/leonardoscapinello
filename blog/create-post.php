<?php
require_once("../src/properties/index.php");
require_once("../src/public/validate-admin.php");
$blog = new Blog();

$title = get_request("post_title");
$id_category = get_request("id_category");
if (not_empty($title) && not_empty($id_category)) {
    $post = $blog->register($title, $id_category);

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

                <form method="POST" action="">
                    <div class="container">
                        <div class="row">
                            <div class="offset-3"></div>
                            <div class="col-xl-6 col-lg-6 col-sm-12">
                                <div class="content-blog" style="margin-top: 50px">

                                    <div class="blog--post-block">
                                        <label class="text black">Digite o título desse artigo.</label>
                                        <div class="blog_input">
                                            <input type="text" name="post_title" value="" maxlength="72">
                                        </div>
                                        <label class="text black">Selecione a categoria</label>
                                        <div class="blog_input">
                                            <select name="id_category">
                                                <?php
                                                $categories = $blog->getCategories();
                                                for ($i = 0; $i < count($categories); $i++) {
                                                    ?>
                                                    <option value="<?= $categories[$i]['id_category'] ?>"><?= $categories[$i]['category_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <br>

                                        <p>Após a criação desse post, você receberá um e-mail para confirmar a criação e
                                            terá acesso aos paineis de edição.</p>
                                        <br>

                                        <div class="blog_input" align="center">
                                            <button class="btn btn--secondary">Criar Rascunho</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="offset-3"></div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>

    <?php require_once(DIRNAME . "../components/footer.php") ?>
</div>


<?php require_once(DIRNAME . "../components/footer-scripts.php") ?>
</body>
</html>