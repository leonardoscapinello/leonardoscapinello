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
                <img src="<?= $static->getImagePath("ls-white-background-black-icon.png") ?>"
                     alt="Leonardo Scapinello"/>
                <h2>Crie sua conta grátis.</h2>
            </div>
            <div class="inputs">
                <div class="input_line">
                    <input type="text" name="first_name" id="first_name" placeholder="Nome" autocomplete="off"/>
                </div>
                <div class="input_line">
                    <input type="text" name="last_name" id="last_name" placeholder="Sobrenome" autocomplete="off"/>
                </div>
                <div class="input_line">
                    <input type="text" name="username" id="username" placeholder="E-mail" autocomplete="off"/>
                </div>
                <div class="input_line">
                    <input type="password" name="password" id="password" placeholder="Senha" autocomplete="off"/>
                </div>
                <div class="input_line bt" align="center">
                    <button class="btn">Criar Conta</button>
                    <a href="<?=LOGIN_URL?>">Já tenho cadastro. Entrar.</a>
                </div>
            </div>
        </div>
    </form>
</div>


<script src="./static/javascript/jquery.min.js"></script>
<script src="./static/javascript/jquery-ui.min.js"></script>
</body>
</html>