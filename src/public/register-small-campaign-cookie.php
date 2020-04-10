<?php
require_once("../properties/index.php");
if ($session->isLogged()) {
    header("location: " . SITE_URL);
    die;
}


$name = get_request("name");
$email = get_request("email");
$phone = get_request("phone");

$accountsTemporaryRegister->setName($name);
$accountsTemporaryRegister->setEmail($email);
$accountsTemporaryRegister->setPhone($phone);

header("location: " . REGISTER_URL);


