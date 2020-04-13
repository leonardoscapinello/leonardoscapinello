<?php
require_once("../properties/index.php");
if ($session->isLogged()) {
    header("location: " . SITE_URL);
    die;
}
$attempt = get_request("attempt");
$username = get_request("username");
if (not_empty($username)) {
    $accountRecovery = new AccountRecovery($username);
    if ($accountRecovery->isUsernameExists()) {
        header("location: " . RECOVERY_URL . "/code?u=" . $text->base64_encode($username) . "&t=" . $text->base64_encode($accountRecovery->getIdRecoveryToken()));
    } else {
        header("location: " . RECOVERY_URL . "?attempt=1");
    }
}
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
    <link href="<?= $static->getFileLocation("bootoast.css") ?>" type="text/css" rel="stylesheet">
</head>
<body>

<div id="authenticate">
    <form action="<?= RECOVERY_URL ?>" method="POST">
        <div class="authentibox">
            <div class="company">
                <a href="<?= SITE_URL ?>" style="margin: 0;">
                    <img src="<?= $static->getImagePath("ls-white-background-black-icon.png") ?>"
                         alt="Leonardo Scapinello"/>
                </a>
                <h2>Qual seu e-mail?</h2>
            </div>


            <div class="inputs">
                <div class="input_line">
                    <input type="text" name="username" value="<?= $username ?>" id="username" placeholder="E-mail"
                           autocomplete="off"/>
                </div>
                <div class="input_line bt" align="center">
                    <button class="btn">Recuperar</button>
                    <a href="<?= LOGIN_URL ?>">Fazer Login</a>
                </div>
            </div>
        </div>
    </form>
</div>


<?php require_once(DIRNAME . "../components/footer-scripts.php") ?>
<?php if (get_request("attempt") === "1") { ?>
    <script type="text/javascript">
        bootoast({
            message: 'Oops! Não foi possível encontrar seu e-mail em nosso portal. Você está buscando criar sua conta? <a href=\"<?=REGISTER_URL?>\">Clique aqui para criar sua conta grátis.</a>',
            position: 'top-right',
            type: 'danger',
            timeout: 2000,
            animationDuration: 300
        });
    </script>
<?php }else{ ?>
<script type="text/javascript">
    bootoast({
        message: 'Serviço de recuperação de senha indisponível no momento. Entre em contato com nosso suporte: suporte@flexwei.com para te ajudarmos com isso.',
        position: 'top-right',
        type: 'danger',
        timeout: 2000,
        animationDuration: 300
    });
</script>
<?php } ?>
</body>
</html>