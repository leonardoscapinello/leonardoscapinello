<?php
ini_set ('display_errors', 'on');
ini_set ('log_errors', 'on');
ini_set ('display_startup_errors', 'on');
ini_set ('error_reporting', E_ALL);
date_default_timezone_set("America/Sao_Paulo");
if (!isset($_SESSION)) {
    session_start();
}

define("DIRNAME", dirname(__FILE__) . "/");
define("SITE_NAME", "Leonardo Scapinello");
define("SITE_URL", "http://leonardoscapinello.com/");
define("LOGIN_URL", SITE_URL . "login");
define("LOGOUT_URL", SITE_URL . "logout");
define("ACCOUNT_PROFILE", SITE_URL . "meu-perfil");
define("REGISTER_URL", SITE_URL . "register");
define("REGISTER_URL_SMALL_FORM_COOKIE", SITE_URL . "register/store");
define("RECOVERY_URL", SITE_URL . "recovery");

define("BLOG", SITE_URL . "blog/");
define("BLOG_POST_PAGE", "{id}/{title}");
define("BLOG_ADMIN_EDIT_POST", SITE_URL . "b/edit-post");
define("BLOG_ADMIN_PUBLISH_POST", SITE_URL . "b/publish");
define("BLOG_ADMIN_SAVE_PARAGRAPH", SITE_URL . "b/save-paragraph");
define("BLOG_ADMIN_ADD_MEDIA", SITE_URL . "b/add-media");
define("BLOG_UPLOADED_FILES_PATH", SITE_URL . "b/media/");
define("BLOG_COVER_PATH", BLOG_UPLOADED_FILES_PATH . "cover/");

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
require_once(DIRNAME . "../functions/stringsafe.php");

require_once(DIRNAME . "/../class/URL.php");
require_once(DIRNAME . "/../class/Text.php");
require_once(DIRNAME . "/../class/Date.php");
require_once(DIRNAME . "/../class/Token.php");
require_once(DIRNAME . "/../class/Numeric.php");
//require_once(DIRNAME . "/../class/lessphp/lessc.inc.php");
require_once(DIRNAME . "/../class/Database.php");
require_once(DIRNAME . "/../class/Campaign.php");
require_once(DIRNAME . "/../class/Accounts.php");
require_once(DIRNAME . "/../class/AccountSession.php");
require_once(DIRNAME . "/../class/AccountTemporary.php");
require_once(DIRNAME . "/../class/Security.php");
require_once(DIRNAME . "/../class/StaticCompiler.php");
require_once(DIRNAME . "/../class/SocialAnalytics.php");
require_once(DIRNAME . "/../class/Blog.php");
require_once(DIRNAME . "/../class/BlogContent.php");
require_once(DIRNAME . "/../class/BlogWidget.php");
require_once(DIRNAME . "/../class/Upload.php");
require_once(DIRNAME . "/../class/BlogSearch.php");
require_once(DIRNAME . "/../class/Pages.php");
require_once(DIRNAME . "/../class/EmailNotification.php");

require DIRNAME . '/../vendor/phpmailer/phpmailer/src/Exception.php';
require DIRNAME . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require DIRNAME . '/../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);


$url = new URL();
$static = new StaticCompiler();
$socialAnalytics = new SocialAnalytics();
//$less = new lessc();
$text = new Text();
$numeric = new Numeric();
$token = new Token();
$date = new Date();
$emailNotification = new EmailNotification();

$database = new Database();

$database->query('SET NAMES utf8');
$database->execute();

$security = new Security();
$session = new AccountSession();
$accounts = $account = new Accounts();
$accountsTemporaryRegister = new AccountTemporary();


//$less->compileFile(DIRNAME . "../../static/less/stylesheet.less", DIRNAME . "../../static/stylesheet/stylesheet.css");

//$static->add(DIRNAME . "../../static/stylesheet/fontawesome.all.min.css");
//$static->add(DIRNAME . "../../static/stylesheet/reset.css");
//$static->add(DIRNAME . "../../static/stylesheet/container.css");
//$static->add(DIRNAME . "../../static/stylesheet/stylesheet.css");
//$static->add(DIRNAME . "../../static/stylesheet/tooltip.css");
//$static->add(DIRNAME . "../../static/fonts/gilroy/Gilroy.css");
//$static->setOutputFile(DIRNAME . "../../static/stylesheet/stylesheet");
//$static->addReplace("../images/", SITE_URL . "static/images/");
//$static->addReplace("../fonts/", SITE_URL . "static/fonts/");
//$static->compileCSS();


ob_start("sanitize_output");