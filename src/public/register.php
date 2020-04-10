<?php
require_once("../properties/index.php");
if ($session->isLogged()) {
    header("location: " . SITE_URL);
    die;
}
$username = get_request("u");
if (not_empty($username)) $username = $text->base64_decode($username);
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link href="<?= $static->getFileLocation("../fonts/gilroy/Gilroy.css") ?>" type="text/css" rel="stylesheet">
    <link href="<?= $static->getFileLocation("authenticate.css") ?>" type="text/css" rel="stylesheet">
</head>
<body>

<div id="authenticate">
    <form action="<?= LOGIN_URL ?>/createaccount" method="POST">
        <div class="authentibox">
            <div class="company">
                <a href="<?= SITE_URL ?>" style="margin: 0;">
                    <img src="<?= $static->getImagePath("ls-white-background-black-icon.png") ?>"
                         alt="Leonardo Scapinello"/>
                </a>
                <h2>Crie sua conta grátis.</h2>
            </div>
            <div class="inputs">

                <?php if ($accountsTemporaryRegister->getFirstName() !== null) { ?>
                    <p class="text white" style="color: #FFFFFF;padding: 10px 20px;line-height: 22px;font-size: 14px">
                        Opa, <b><?= $accountsTemporaryRegister->getFirstName() ?></b>, tudo bem por ai?<br/>Falta pouco
                        pra você criar sua conta grátis.</p>
                <?php } ?>


                <div class="input_line" <?= $accountsTemporaryRegister->getFirstName() !== null ? "style=\"display:none;\"" : "" ?>>
                    <input type="text" name="first_name" id="first_name"
                           value="<?= $accountsTemporaryRegister->getFirstName() ?>" placeholder="Nome"
                           autocomplete="off"/>
                </div>
                <div class="input_line" <?= $accountsTemporaryRegister->getLastName() !== null ? "style=\"display:none;\"" : "" ?>>
                    <input type="text" name="last_name" id="last_name"
                           value="<?= $accountsTemporaryRegister->getLastName() ?>" placeholder="Sobrenome"
                           autocomplete="off"/>
                </div>
                <div class="input_line" <?= $accountsTemporaryRegister->getEmail() !== null ? "style=\"display:none;\"" : "" ?>>
                    <input type="text" name="username" id="username"
                           value="<?= $accountsTemporaryRegister->getEmail() ?>" placeholder="E-mail"
                           autocomplete="off"/>
                </div>
                <div class="input_line" <?= $accountsTemporaryRegister->getPhone() !== null ? "style=\"display:none;\"" : "" ?>>
                    <input type="text" name="phone" id="phone" class="phone_with_ddd"
                           value="<?= $accountsTemporaryRegister->getPhone() ?>"
                           placeholder="WhatsApp" autocomplete="off"/>
                </div>
                <div class="input_line">
                    <input type="password" name="password" id="password" value="" placeholder="Senha"
                           autocomplete="off"/>
                </div>
                <div class="input_line bt" align="center">
                    <button class="btn">Criar Conta</button>
                    <a href="<?= LOGIN_URL ?>">Já tenho cadastro. Entrar.</a>
                </div>
            </div>
        </div>
    </form>
</div>


<?php require_once(DIRNAME . "../components/footer-scripts.php") ?>
</body>
</html>