<?php
if (!$session->isLogged()) {
    header("location: " . LOGIN_URL);
    die;
}