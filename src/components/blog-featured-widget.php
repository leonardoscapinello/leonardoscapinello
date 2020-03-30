<section>
    <div class="blog-release">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-sm-12">
                    <h3>Procurando por conteúdo?</h3>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-12">
                    <div class="blog-release-notifications text right" tooltip="Ativar notificações" flow="top">
                        <button class="btn btn--transparent"><i class="far fa-bell"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="owl-carousel blog-carousel owl-theme">

            <?php for ($i = 0; $i < 6; $i++) { ?>

                <div class="blog-post--widget">
                    <div class="background">
                        <img src="<?= $stylesheet->getImagePath("pexels-photo-2-_opt-800x534.jpg", "blog") ?>"
                             alt="Background"/>
                    </div>
                    <div class="post-info">
                        <div class="content">
                            <div class="stamp">DINHEIRO</div>
                            <h5>Aprenda como ganhar dinheiro na internet seguindo esse método de 5 passos
                                simple
                                ainda hoje</h5>
                            <a href="./blog/126/aprenda-a-ganhar-dinheiro-na-internet-seguindo-esse-metodo-de-cinco-passos-simples-ainda-hoje">Ler Postagem</a>
                        </div>
                    </div>
                </div>

            <?php } ?>


        </div>


    </div>
</section>