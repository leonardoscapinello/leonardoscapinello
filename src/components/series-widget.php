<section>
    <div class="container-gradient series">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-sm-12">
                        <div class="blog-release-notifications text " style="float: left;margin-right: 15px"
                             tooltip="Ativar notificações"   flow="top">
                            <button class="btn btn--transparent"><i class="far fa-bell"></i></button>
                        </div>
                        <h3>Lançamentos • Séries</h3>
                    </div>
                </div>
            </div>
            <div class="owl-carousel blog-carousel owl-theme">

                <?php for ($i = 0; $i < 6; $i++) { ?>
                    <div class="blog-post--widget locked">
                        <div class="background">
                            <img src="<?=$static->getImagePath("series-default-background.png")?>"/>
                        </div>
                        <div class="post-info">
                            <div class="content">
                                <div class="stamp" style="background:#2d2d2d">SÉRIE</div>
                                <h5>Em Breve</h5>
                                <span class="readmore">Acompanhar</span>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</section>