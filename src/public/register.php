<?php
require_once("../properties/index.php");
if ($session->isLogged()) {
    header("location: " . SITE_URL);
    die;
}
$username = get_request("u");
$attempt = get_request("attempt");
if (not_empty($username)) $username = $text->base64_decode($username);

$message = "";
if ($attempt === $text->base64_encode("-1")) $message = "Preencha seu Primeiro Nome Corretamente.";
if ($attempt === $text->base64_encode("-2")) $message = "Preencha seu Sobrenome Corretamente.";
if ($attempt === $text->base64_encode("-3")) $message = "Preencha seu E-mail Corretamente.";
if ($attempt === $text->base64_encode("-4")) $message = "Preencha sua Senha com no mínimo 6 digitos.";
if ($attempt === $text->base64_encode("-5")) $message = "Preencha seu WhatsApp Corretamente.";
if ($attempt === $text->base64_encode("0")) $message = "Já existe um usuário com esse e-mail.";


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
    <form action="<?= LOGIN_URL ?>/createaccount" method="POST" onSubmit="register()">
        <div class="authentibox">
            <div class="company">
                <a href="<?= SITE_URL ?>" style="margin: 0;">
                    <img src="<?= $static->getImagePath("ls-white-background-black-icon.png") ?>"
                         alt="Leonardo Scapinello"/>
                </a>
                <?php if (not_empty($attempt) && not_empty($message)) { ?>
                    <h2 style="color: #ed145b"><?= $message ?></h2>
                <?php } else { ?>
                    <h2>Crie sua conta grátis.</h2>
                <?php } ?>
            </div>
            <div class="inputs">

                <?php if ($accountsTemporaryRegister->getFirstName() !== "") { ?>
                    <p class="text white" style="color: #FFFFFF;padding: 10px 20px;line-height: 22px;font-size: 14px">
                        Opa, <b><?= $accountsTemporaryRegister->getFirstName() ?></b>, tudo bem por ai?<br/>Falta pouco
                        pra você criar sua conta grátis.</p>
                <?php } ?>


                <div class="input_line" <?= $accountsTemporaryRegister->getFirstName() !== "" ? "style=\"display:none;\"" : "" ?>>
                    <input type="text" name="first_name" id="first_name"
                           value="<?= $accountsTemporaryRegister->getFirstName() ?>" placeholder="Nome"
                           autocomplete="off" required minlength="2"/>
                </div>
                <div class="input_line" <?= $accountsTemporaryRegister->getLastName() !== "" ? "style=\"display:none;\"" : "" ?>>
                    <input type="text" name="last_name" id="last_name"
                           value="<?= $accountsTemporaryRegister->getLastName() ?>" placeholder="Sobrenome"
                           autocomplete="off" required minlength="2"/>
                </div>
                <div class="input_line" <?= $accountsTemporaryRegister->getEmail() !== null ? "style=\"display:none;\"" : "" ?>>
                    <input type="email" name="username" id="username"
                           value="<?= $accountsTemporaryRegister->getEmail() ?>" placeholder="E-mail"
                           autocomplete="off" required minlength="6"/>
                </div>
                <div class="input_line" <?= $accountsTemporaryRegister->getPhone() !== null ? "style=\"display:none;\"" : "" ?>>
                    <input type="text" name="phone" id="phone" class="phone_with_ddd"
                           value="<?= $accountsTemporaryRegister->getPhone() ?>"
                           placeholder="WhatsApp" required autocomplete="off"/>
                </div>
                <div class="input_line">
                    <input type="password" name="password" id="password" value="" placeholder="Senha"
                           autocomplete="off" required minlength="6"/>
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