<?php
require_once("../properties/index.php");
if ($session->isLogged()) {
    $session->cleanSession();
}

header("location: " . SITE_URL);
die;
