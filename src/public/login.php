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
    <link href="<?= $static->getFileLocation("bootoast.css") ?>" type="text/css" rel="stylesheet">
</head>
<body>

<div id="authenticate">
    <form action="<?= LOGIN_URL ?>/createsession" method="POST">
        <div class="authentibox">
            <div class="company">
                <a href="<?= SITE_URL ?>" style="margin: 0;">
                    <img src="<?= $static->getImagePath("ls-white-background-black-icon.png") ?>"
                         alt="Leonardo Scapinello"/>
                </a>
                <?php if (get_request("attempt")) { ?>
                    <h2 style="color: #ed145b">Usuário ou Senha Incorretos.</h2>
                <?php } else { ?>
                    <h2>Entre com sua conta.</h2>
                <?php } ?>
            </div>


            <div class="inputs">
                <div class="input_line">
                    <input type="text" name="username" value="<?= $username ?>" id="password" placeholder="E-mail"
                           autocomplete="off"/>
                </div>
                <div class="input_line">
                    <input type="password" name="password" id="password" placeholder="Senha" autocomplete="off"/>
                </div>
                <div class="input_line bt" align="center">
                    <button class="btn">Entrar</button>
                    <a href="<?= RECOVERY_URL ?>">Recuperar minha senha</a>
                    <a href="<?= REGISTER_URL ?>">Criar minha Conta Grátis</a>
                </div>
            </div>
        </div>
    </form>
</div>


<?php require_once(DIRNAME . "../components/footer-scripts.php") ?>
<?php if (get_request("attempt") !== null) { ?>
    <script type="text/javascript">
        bootoast({
            message: 'Usuário ou Senha Incorretos.',
            position: 'top-right',
            type: 'danger',
            timeout: 2000,
            animationDuration: 300
        });
    </script>
<?php }else if (get_request("u") !== null) { ?>
<?php if (get_request("recover") === "Y") { ?>
    <script type="text/javascript">
        bootoast({
            message: '<b>É isso ai!</b> Sua nova senha já pode ser usada. ',
            position: 'top-right',
            type: 'success',
            timeout: 2000,
            animationDuration: 300
        });
    </script>
<?php }else { ?>
    <script type="text/javascript">
        bootoast({
            message: '<b>Seja bem-vindo(a)!</b> Sua conta foi criada com sucesso e você já pode acessar todo o conteúdo.',
            position: 'top-right',
            type: 'success',
            timeout: 2000,
            animationDuration: 300
        });
    </script>
<?php } ?>
<?php } ?>
</body>
</html>