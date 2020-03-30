<?php
require_once("../../src/properties/index.php");
if ($session->isLogged()) {
    header("location: " . SITE_URL);
    die;
}

header("location: " . LOGIN_URL);