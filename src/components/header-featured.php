<header>
    <div class="main-wrap featured">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-1 col-lg-1 col-sm-12">
                        <div class="ls-branding"></div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-sm-12">
                        <div class="navigation">
                            <ul>
                                <li><a href="<?= SITE_URL ?>" title="Página Inicial">Página Inicial</a></li>
                                <li><a href="<?= SITE_URL ?>empresa-online" title="Sua Empresa Online">Sua
                                        Empresa
                                        Online</a></li>
                                <li><a href="<?= SITE_URL ?>blog" title="Página Inicial">Blog</a></li>
                                <li><a href="<?= SITE_URL ?>blog" title="Página Inicial">Contato </a></li>
                                <li><a href="<?= SITE_URL ?>blog" title="Página Inicial">Baixar E-book Grátis
                                        <span class="stamp">Novo</span>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-sm-12">
                        <div class="header-btn">
                            <button tooltip="Acessar minha Conta"
                                    class="btn only-desktop"
                                    flow="down" onClick="window.location.href = '<?=LOGIN_URL?>';return false">Fazer Login
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="presentation">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-sm-12">

                            <div class="headline  vertical-middle">
                                <sup class="text pink">IMPEDIDO DE VENDER?</sup>
                                <h2>Sobreviva ao Corona: Conheça esse material feito para ajudar empreendedores.</h2>
                                <p class="text white topmargin">Enquanto o comércio fecha as portas, abra um novo canal
                                    de
                                    vendas. Conteúdo inédito e
                                    exclusivo por tempo limitado.</p>
                                <button tooltip="Continuar Lendo no Blog" class="only-desktop btn " flow="down">
                                    Continuar
                                    Lendo
                                </button>
                            </div>

                        </div>
                        <div class="col-xl-6 col-lg-6 col-sm-12">
                            <div class="hd-cover">
                                <img src="<?= $stylesheet->getImagePath("ebook-sobreviva-ao-corona.png", "sobreviva-ao-corona") ?>"
                                     alt=" E-book Sobreviva ao Coronavírus">
                            </div>
                            <button tooltip="Continuar Lendo no Blog" class="only-mobile btn " flow="down">Continuar
                                Lendo
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
</header>