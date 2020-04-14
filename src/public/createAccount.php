<?php
require_once("../properties/index.php");

$next = get_request("next");
$first_name = get_request("first_name");
$last_name = get_request("last_name");
$username = get_request("username");
$password = get_request("password");
$phone = get_request("phone");

if (!not_empty($next)) $next = LOGIN_URL . "?u=" . $text->base64_encode($username);


$reg = $account->register($first_name, $last_name, $username, $password, $phone);

if ($reg > 0) {
    header("location: " . $next);
    die;
} else {
    $tmp = new AccountTemporary();
    $tmp->setName($first_name . " " . $last_name);
    $tmp->setPhone($phone);
    header("location: " . SITE_URL . "register?attempt=" . $text->base64_encode($reg));
    die;
}

