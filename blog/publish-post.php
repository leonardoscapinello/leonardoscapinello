<?php
require_once("../src/properties/index.php");
$id = get_request("id");

$blog = new Blog($id);
$blog->publish($id);

header("location: " . $blog->getPostURL());

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
</head>
<body>
<div id="wrapper">
    <?php require_once(DIRNAME . "../components/header.php") ?>

    <section>
        <div class="blog-post">
            <div class="post-content">

                <div class="container">
                    <div class="row">
                        <div class="offset-3"></div>
                        <div class="col-xl-6 col-lg-6 col-sm-12">
                            <div class="content-blog" style="margin-top: 50px">

                                <div class="blog--post-block text center" align="center">

                                    <div class="loader loader--style2" title="1">
                                        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             x="0px" y="0px"
                                             width="100px" height="100px" viewBox="0 0 50 50"
                                             style="enable-background:new 0 0 50 50;"
                                             xml:space="preserve">
                                          <path fill="#000"
                                                d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
                                              <animateTransform attributeType="xml"
                                                                attributeName="transform"
                                                                type="rotate"
                                                                from="0 25 25"
                                                                to="360 25 25"
                                                                dur="0.6s"
                                                                repeatCount="indefinite"/>
                                          </path>
                                          </svg>
                                    </div>


                                </div>

                            </div>
                        </div>
                        <div class="offset-3"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php require_once(DIRNAME . "../components/footer.php") ?>
</div>


<?php require_once(DIRNAME . "../components/footer-scripts.php") ?>
</body>
</html>