<?php
require_once("../properties/index.php");
if ($session->isLogged()) {
    header("location: " . SITE_URL);
    die;
}

$user = get_request("u");
$code = get_request("c");

if (not_empty($user) && not_empty($code)) {
    $username = $text->base64_decode($user);
    $code = $text->base64_decode($code);
    $accountRecovery = new AccountRecovery($username);
    $validate = $accountRecovery->validate($code);
    if ($validate) {
        header("location: " . RECOVERY_URL . "/validate?u=" . $user . "&c=" . $text->base64_encode($code));
        die;
    } else {
        header("location: " . RECOVERY_URL . "/code?u=" . $user . "&attempt=1");
        die;
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
    <form action="" method="POST">
        <div class="authentibox">
            <div class="company">
                <a href="<?= SITE_URL ?>" style="margin: 0;">
                    <img src="<?= $static->getImagePath("ls-white-background-black-icon.png") ?>"
                         alt="Leonardo Scapinello"/>
                </a>
                <h2>Só pra confirmar...</h2>
                <p class="text white" style="color: #FFF;font-size: 13px;margin-bottom: 30px">Te enviamos um código para
                    confirmar que foi você mesmo, quem solicitou a alteração de senha. Dentro de instantes deve
                    recebe-lo por e-mail.</p>
            </div>


            <div class="inputs">
                <input type="hidden" name="u" id="u" value="<?= $user ?>"/>
                <div class="input_line">
                    <input type="text" name="c" value="" id="c" placeholder="Digite o código de 6 digitos aqui"
                           autocomplete="off" style="text-align: center;letter-spacing: 24px;text-transform: uppercase;"
                           minlength="6" maxlength="6" required/>
                </div>
                <div class="input_line bt" align="center">
                    <button class="btn">Confirmar</button>
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
            message: '<b>Wooops! O código que você digitou não é exatamente o que esperavamos...</b><br /> Enviamos esse código por e-mail (não esqueça de olhar o SPAM) e só vale por 02 horas.',
            position: 'top-right',
            type: 'danger',
            timeout: 2000,
            animationDuration: 300
        });
    </script>
<?php } ?>
</body>
</html>