<?php

class AccountTemporary extends Text
{

    private $cookie_name_prefix = "LS_TEMP_";

    private function getCookie($index)
    {
        try {
            if (isset($_COOKIE[$index])) {
                if ($_COOKIE[$index] !== null && $_COOKIE[$index] !== "") {
                    return $this->base64_decode($_COOKIE[$index]);
                }
            }
        } catch (Exception $exception) {
            error_log("getCookie: " . $exception);
        }
        return null;
    }

    public function setName($name)
    {
        setcookie($this->cookie_name_prefix . "NA", $this->base64_encode($name), time() + (86400 * 30), "/");
    }

    public function setEmail($email)
    {
        setcookie($this->cookie_name_prefix . "EM", $this->base64_encode($email), time() + (86400 * 30), "/");
    }

    public function setPhone($phone)
    {
        setcookie($this->cookie_name_prefix . "PH", $this->base64_encode($phone), time() + (86400 * 30), "/");
    }

    public function getName()
    {
        global $accounts;
        global $session;
        if ($session->isLogged(false)) return $accounts->getFullName();
        return $this->getCookie($this->cookie_name_prefix . "NA");
    }


    private function splitName()
    {
        $name = $this->getName();
        $name = trim($name);
        $last_name = (strpos($name, " ") === false) ? "" : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
        return array($first_name, $last_name);
    }


    public function getFirstName()
    {
        $f = $this->splitName();
        return trim($f[0]);
    }

    public function getLastName()
    {
        $f = $this->splitName();
        return trim($f[1]);
    }

    public function getEmail()
    {
        global $accounts;
        global $session;
        if ($session->isLogged(false)) return $accounts->getEmail();
        return $this->getCookie($this->cookie_name_prefix . "EM");
    }

    public function getPhone()
    {
        global $accounts;
        global $session;
        if ($session->isLogged(false)) return $accounts->getPhoneNumber();
        return $this->getCookie($this->cookie_name_prefix . "PH");
    }

    public function cleanTemporaryData()
    {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                if ($name !== "PHPSESSID" && strpos($name, $this->cookie_name_prefix) !== FALSE) {
                    setcookie($name, '', time() - 1000);
                    setcookie($name, '', time() - 1000, '/');
                    unset($name);
                }
            }
        }
    }

}
