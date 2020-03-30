<?php
require_once("../properties/index.php");
$username = get_request("username");
$password = get_request("password");

$session->setUsername($username);
$session->setPassword($password);

if ($session->isLogged()) {
    header("location: " . SITE_URL);
    die;
} else {
    if ($session->createSession()) {
        header("location: " . SITE_URL);
        die;
    } else {
        header("location: " . LOGIN_URL . "?attempt=1");
        die;
    }
}