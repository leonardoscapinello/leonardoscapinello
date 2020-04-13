<?php
require_once("../properties/index.php");
if ($session->isLogged()) {
    header("location: " . SITE_URL);
    die;
}

$user = get_request("u");
$code = get_request("c");
$password = get_request("password");

if (not_empty($user) && not_empty($code)) {
    $username = $text->base64_decode($user);
    $code_decoded = $text->base64_decode($code);
    $accountRecovery = new AccountRecovery($username);
    $validate = $accountRecovery->validate($code_decoded);
    if (!$validate) {
        header("location: " . RECOVERY_URL . "/code?u=" . $user . "&attempt=1");
        die;
    }

    if (not_empty($password)) {

        error_log("recover to " . $accountRecovery->getIdAccount());
        error_log("recover to password " . $password);

        $accountToRecovery = new Accounts($accountRecovery->getIdAccount());
        $changed = $accountToRecovery->resetPassword($password, $password);
        if ($changed) {
            header("location: " . LOGIN_URL . "?u=" . $user . "&recover=Y");
            die;
        }
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
                <h2>Chegou a hora!</h2>
                <p class="text white" style="color: #FFF;font-size: 13px;margin-bottom: 30px">Obrigado por confirmar,
                    isso garante sua segurança! Vamos ao grande momento, recuperar sua senha?</p>
            </div>


            <div class="inputs">
                <input type="hidden" name="u" value="<?= $user ?>"/>
                <input type="hidden" name="c" value="<?= $code ?>"/>
                <div class="input_line">
                    <input type="password" name="password" value="" id="password" placeholder="Digite sua nova senha"
                           autocomplete="off"
                           minlength="6" maxlength="24" required/>
                </div>
                <div class="input_line bt" align="center">
                    <button class="btn">Alterar Senha</button>
                    <a href="<?= LOGIN_URL ?>">Fazer Login</a>
                </div>
            </div>
        </div>
    </form>
</div>


<?php require_once(DIRNAME . "../components/footer-scripts.php") ?>
<script type="text/javascript">
    /*bootoast({
        message: 'Serviço de recuperação de senha indisponível no momento. Entre em contato com nosso suporte: suporte@flexwei.com para te ajudarmos com isso.',
        position: 'top-right',
        type: 'danger',
        timeout: 2000,
        animationDuration: 300
    });*/
</script>
</body>
</html>