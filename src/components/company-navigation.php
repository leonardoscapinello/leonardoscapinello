<div class="container">
    <div class="row">
        <div class="col-xl-1 col-lg-1 col-sm-12">
            <div class="ls-branding"></div>
        </div>
        <div class="col-xl-9 col-lg-9 col-sm-12">
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
                <?php if ($session->isLogged()) { ?>
                    <button tooltip="Acessar meu Perfil"
                            class="btn only-desktop"
                            flow="down" onClick="window.location.href = '<?= SITE_URL ?>';return false">Olá, <?=$account->getFirstName()?>
                    </button>
                <?php } else { ?>
                    <button tooltip="Acessar minha Conta"
                            class="btn only-desktop"
                            flow="down" onClick="window.location.href = '<?= LOGIN_URL ?>';return false">Fazer Login
                    </button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>