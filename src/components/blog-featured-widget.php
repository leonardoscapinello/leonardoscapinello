<section>
    <div class="blog-release">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-sm-12">
                    <div class="blog-release-notifications text " style="float: left;margin-right: 15px"
                         tooltip="Ativar notificações" flow="top">
                        <button class="btn btn--transparent"><i class="far fa-bell"></i></button>
                    </div>
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