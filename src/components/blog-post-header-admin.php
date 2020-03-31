<?php
$cover = $static->getImagePath($blog->getPostCover(), "blog");
?>
<section>
    <div class="blog-post">
        <div class="header-blog <?= $cover === null ? "noimage" : "" ?> ">
            <div class="background">
                <img src="<?= $cover ?>" alt=""/>
                <div class="overlay-text">
                    <div class="post-title">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-sm-12">
                                    <h2><?= $blog->getPostTitle() ?> </h2>
                                    <div class="post-data">
                                        <ul>
                                            <li><i class="far fa-clock"></i> 22/10/2020</li>
                                            <li><i class="far fa-user"></i> <?= $author->getFullName() ?></li>
                                            <li><span class="stamp" style="margin: 0;top: 0;">DINHEIRO</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>