<div class="header--company header--navigation">
    <div class="container">
        <div class="row">
            <div class="col-xl-1 third-part">
                <a href="<?= SITE_URL ?>">
                    <div class="ls-branding"></div>
                </a>
            </div>
            <div class="col-xl-8 third-part">
                <div class="navigation" id="header-nav">
                    <ul>
                        <li class="only-mobile"><a href="#" onClick="navigation();"><i
                                        class="far fa-arrow-left"></i>
                                Voltar</a>
                        </li>
                        <li><a href="<?= SITE_URL ?>">Página Inicial</a></li>
                        <li><a href="<?= SITE_URL ?>empresa-online" title="Sua Empresa Online">Sua
                                Empresa
                                Online</a></li>
                        <li><a href="<?= SITE_URL ?>blog">Contato </a></li>
                        <li><a href="<?= SITE_URL ?>blog">Baixar E-book Grátis
                                <span class="stamp">Novo</span>
                            </a></li>
                        <?php if ($session->isLogged()) { ?>
                            <li class="only-mobile account">
                                <a href="<?= ACCOUNT_PROFILE ?>">Olá, <?= $account->getFirstName() ?></a>
                            </li>
                            <li class="only-mobile"><a href="<?= LOGOUT_URL ?>">Desconectar</a></li>
                        <?php } else { ?>
                            <li class="only-mobile"><a href="<?= LOGIN_URL ?>">Fazer Login</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-xl-1 only-desktop">
                <div class="navigation-mobile-btn" onClick="navigation();">
                    <i class="far fa-search"></i>
                </div>
            </div>
            <div class="col-xl-2 third-part">
                <div class="header-btn">
                    <?php if ($session->isLogged()) { ?>
                        <button tooltip="Acessar meu Perfil"
                                class="btn only-desktop"
                                flow="down" onClick="window.location.href = '<?= SITE_URL ?>';return false">
                            Olá, <?= $account->getFirstName() ?>
                        </button>
                    <?php } else { ?>
                        <button tooltip="Acessar minha Conta"
                                class="btn only-desktop"
                                flow="down" onClick="window.location.href = '<?= LOGIN_URL ?>';return false">Fazer Login
                        </button>
                    <?php } ?>
                </div>

                <div class="navigation-mobile-btn only-mobile" onClick="navigation();">
                    <i class="far fa-bars"></i>
                </div>
            </div>
        </div>
    </div>
</div>