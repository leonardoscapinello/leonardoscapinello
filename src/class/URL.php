<?php

class URL
{

    public function getActualURL()
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public function addQueryString($array)
    {
        $url = $this->getActualURL();
        if ($this->queryStringExists($url)) {
            return $url . "&" . http_build_query($array);
        } else {
            return $url . "?" . http_build_query($array);
        }
    }

    public function removeQueryString($key)
    {
        $url = $this->getActualURL();
        $url = preg_replace('/(?:&|(\?))' . $key . '=[^&]*(?(1)&|)?/i', "$1", $url);
        $url = rtrim($url, '?');
        $url = rtrim($url, '&');
        return $url;
    }

    private function queryStringExists($url)
    {
        if (false !== strpos($url, '?')) {
            return true;
        }
        return false;
    }


}