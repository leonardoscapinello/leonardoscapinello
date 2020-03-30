<?php
require_once("../properties/index.php");

$next = get_request("next");
$first_name = get_request("first_name");
$last_name = get_request("last_name");
$username = get_request("username");
$password = get_request("password");

if (!not_empty($next)) $next = SITE_URL;


if ($account->register($first_name, $last_name, $username, $password)) {
    header("location: " . $next);
    die;
}else{
    header("location: " . SITE_URL . "register?attempt=1");
    die;
}

