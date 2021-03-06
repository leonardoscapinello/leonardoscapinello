<section>
    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-sm-12">
                    <div class="ct--post-video">
                        <div class="ls-player-container half-player">
                            <video poster="<?= $static->getMoviePath("leonardoscapinello-showcase-thumb.png") ?>"
                                   class="ls-player ">
                                <source src="<?= $static->getMoviePath("leonardoscapinello-showcase.mp4") ?>"
                                        type="video/mp4"/>
                            </video>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-sm-12">
                    <div class="x-box">
                        <h3 class="">Crie sua Conta Gratuita</h3>
                        <p class="text white topmargin">Receba por e-mail notificações sempre que um novo conteúdo for
                            postado aqui, gerencie suas preferências e garanta um conteúdo de qualidade e gratuito.</p>
                        <button class="btn topmargin"
                                onClick="window.location.href = '<?= REGISTER_URL ?>';return false">Criar minha conta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>