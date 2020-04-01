<?php
if (!$session->isLogged()) {
    header("location: " . LOGIN_URL);
    die;
} else {
    $checkAdminAccount = new Accounts($session->getIdAccount());
    if ($checkAdminAccount->isCustomer()) {
        header("location: " . SITE_URL);
        die;
    }
}