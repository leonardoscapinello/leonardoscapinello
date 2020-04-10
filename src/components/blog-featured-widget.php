<section>
    <div class="blog-release">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-sm-12">
                    <?php if ($session->isLogged()) { ?>
                        <h3>O que há de novo</h3>
                    <?php } else { ?>
                        <h3>Procurando por conteúdo?</h3>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="owl-carousel blog-carousel owl-theme">

            <?php
            $blogWidget = new BlogWidget();
            echo $blogWidget->getFeatured(10);
            ?>


        </div>


    </div>
</section>