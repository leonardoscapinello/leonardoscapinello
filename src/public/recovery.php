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
        $accountRecovery->notify();
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
            <?php if (!isset($_COOKIE['LS_RECOVER_REQUEST'])) { ?>
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
            <?php } else { ?>
                <div class="company">
                    <a href="<?= SITE_URL ?>" style="margin: 0;">
                        <img src="<?= $static->getImagePath("ls-white-background-black-icon.png") ?>"
                             alt="Leonardo Scapinello"/>
                    </a>
                    <h2>Você ainda não recebeu?</h2>
                    <p style="color: #FFFFFF">Nós te enviamos um e-mail com instruções para recuperar sua senha, se você ainda não recebeu,
                        entre em contato com nosso suporte para que possamos te ajudar.</p>
                </div>
            <?php } ?>
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
<?php } ?>
</body>
</html>