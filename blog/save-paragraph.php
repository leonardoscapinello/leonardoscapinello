<?php
require_once("../src/properties/index.php");
require_once("../src/public/validate-admin.php");

$id_post = get_request("id_post");
$id_paragraph = get_request("id_paragraph");
$post_content = get_request("P" . $id_paragraph);

foreach ($_POST as $key => $value) {
    error_log($key . " >> " . $value);
}


$post_content_treatment = htmlentities($post_content, ENT_NOQUOTES, "UTF-8", false);
$post_content_treatment = str_replace(array("&lt;", "&gt;"), array("<", ">"), $post_content_treatment);
$post_content_treatment = trim($post_content_treatment);


$post_content_html = $post_content_treatment;


$blogContent = new BlogContent();

if ($id_paragraph === null || $id_paragraph === "0") {
    $blogContent->register($post_content_html, "paragraph", $id_post);
} else {
    $blogContent->update($post_content_html, $id_paragraph);
}