<?php
date_default_timezone_set("America/Sao_Paulo");
include '../../../src/class/GIFEncoder.class.php';
include '../../../src/functions/get_request.php';


$date = get_request("date");
$hour = get_request("hour");
$background = get_request("bg");
$font = get_request("font");

/* ============= TEXT COLOR */
$textColor = get_request("textColor") === null ? "255,255,255" : get_request("textColor");
$textColor = explode(",", $textColor);
$text_R = $textColor[0];
$text_G = $textColor[1];
$text_B = $textColor[2];

/* ============= TIME */
$time = $date . " " . $hour;
$time_now = date('Y-m-d H:i:s');
$future_timestamp = date('Y-m-d H:i:s', strtotime($time));
$future_date = new DateTime();
$future_date->setTimestamp(strtotime($future_timestamp));
$now = new DateTime();
$now->setTimestamp(strtotime($time_now));

/* ============= BACKGROUND */
if ($background === null) $background = "countdown-clock.png";
if ($font === null) $font = dirname(__FILE__) . '/../../fonts/gilroy/Gilroy-Bold.ttf';

$loops = 1;
$frames = array();
$delays = array();


try {

    if ($text_R === null) $text_R = 255;
    if ($text_G === null) $text_G = 255;
    if ($text_B === null) $text_B = 255;

    $image = imagecreatefrompng($background);
    $delay = 100; // milliseconds
    $font = array(
        'size' => 40,
        'angle' => 0,
        'x-offset' => 150,
        'y-offset' => 70,
        'file' => $font,
        'color' => imagecolorallocate($image, $text_R, $text_G, $text_B),
    );
    for ($i = 0; $i <= 60; $i++) {
        $interval = date_diff($future_date, $now);
        if ($future_date < $now) {
            // Open the first source image and add the text.
            $image = imagecreatefrompng($background);
            $text = $interval->format('00:00:00:00');
            imagettftext($image, $font['size'], $font['angle'], $font['x-offset'], $font['y-offset'], $font['color'], $font['file'], $text);
            ob_start();
            imagegif($image);
            $frames[] = ob_get_contents();
            $delays[] = $delay;
            $loops = 1;
            ob_end_clean();
            break;
        } else {
            // Open the first source image and add the text.
            $image = imagecreatefrompng($background);
            $text = $interval->format('%a:%H:%I:%S');
            // %a is weird in that it doesn’t give you a two digit number
            // check if it starts with a single digit 0-9
            // and prepend a 0 if it does
            if (preg_match('/^[0-9]\:/', $text)) {
                $text = '0' . $text;
            }
            imagettftext($image, $font['size'], $font['angle'], $font['x-offset'], $font['y-offset'], $font['color'], $font['file'], $text);
            ob_start();
            imagegif($image);
            $frames[] = ob_get_contents();
            $delays[] = $delay;
            $loops = 0;
            ob_end_clean();
        }
        $now->modify('+1 second');
    }
} catch (Exception $exception) {
    error_log($exception);
}

header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Content-type: image/gif');
$gif = new AnimatedGif($frames, $delays, $loops);
$gif->display();
