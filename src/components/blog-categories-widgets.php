<?php
$blog = new Blog();
$categories = $blog->getCategories();
if (count($categories) > 0) {
    for ($i = 0; $i < count($categories); $i++) {
        ?>

        <section>
            <div class="blog-release">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-sm-12">
                            <div class="blog-release-notifications text " style="float: left;margin-right: 15px"
                                 tooltip="Ativar notificações" flow="top">
                                <button class="btn btn--transparent"><i class="far fa-bell"></i></button>
                            </div>
                            <h3><?= $categories[$i]['category_name'] ?></h3>
                        </div>
                    </div>
                </div>

                <div class="owl-carousel categories-carousel owl-theme">

                    <?php
                    $blogWidget = new BlogWidget();
                    echo $blogWidget->getFeatured(10, $categories[$i]['id_category']);
                    ?>


                </div>


            </div>
        </section>
    <?php } ?>
<?php } ?>