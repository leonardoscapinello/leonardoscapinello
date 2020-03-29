<?php


date_default_timezone_set("America/Sao_Paulo");
if (!isset($_SESSION)) {
    session_start();
}

define("DIRNAME", dirname(__FILE__) . "/");
define("SITE_URL", "http://localhost/leonardoscapinello/");

require_once(DIRNAME . "../vendor/autoload.php");


require_once(DIRNAME . "/../functions/http_response_code.php");
require_once(DIRNAME . "/../functions/user_agent.php");
require_once(DIRNAME . "../functions/notempty.php");
require_once(DIRNAME . "../functions/XML2Array.php");
require_once(DIRNAME . "../functions/sanitize_output.php");
require_once(DIRNAME . "../functions/translate.php");
require_once(DIRNAME . "../functions/get_request.php");
require_once(DIRNAME . "../functions/is_selected.php");
require_once(DIRNAME . "../functions/get_page.php");


require_once(DIRNAME . "/../class/lessphp/lessc.inc.php");
require_once(DIRNAME . "/../class/Database.php");
require_once(DIRNAME . "/../class/Campaign.php");
require_once(DIRNAME . "/../class/StyleSheetCompiler.php");
require_once(DIRNAME . "/../class/SocialAnalytics.php");

require DIRNAME . '/../vendor/phpmailer/phpmailer/src/Exception.php';
require DIRNAME . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require DIRNAME . '/../vendor/phpmailer/phpmailer/src/SMTP.php';


$stylesheet = new StyleSheetCompiler();
$less = new lessc();
$socialAnalytics = new SocialAnalytics();

$less->compileFile(DIRNAME . "../../static/less/stylesheet.less", DIRNAME . "../../static/stylesheet/stylesheet.css");

$stylesheet->add(DIRNAME . "../../static/stylesheet/fontawesome.all.min.css");
$stylesheet->add(DIRNAME . "../../static/stylesheet/reset.css");
$stylesheet->add(DIRNAME . "../../static/stylesheet/container.css");
$stylesheet->add(DIRNAME . "../../static/stylesheet/stylesheet.css");
$stylesheet->add(DIRNAME . "../../static/stylesheet/tooltip.css");
$stylesheet->add(DIRNAME . "../../static/fonts/gilroy/Gilroy.css");
$stylesheet->setOutputFile(DIRNAME . "../../static/stylesheet/stylesheet");
$stylesheet->addReplace("../images/", SITE_URL . "static/images/");
$stylesheet->addReplace("../fonts/", SITE_URL . "static/fonts/");
$stylesheet->compileCSS();


ob_start("sanitize_output");