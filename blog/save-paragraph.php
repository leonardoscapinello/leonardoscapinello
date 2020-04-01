<?php
require_once("../src/properties/index.php");
require_once("../src/public/validate-admin.php");

$post_content = $_POST[0];
$id_post = $_POST[1];

$post_content_treatment = htmlentities($post_content, ENT_NOQUOTES, "UTF-8", false);
$post_content_treatment = str_replace(array("&lt;", "&gt;"), array("<", ">"), $post_content_treatment);
$post_content_treatment = trim($post_content_treatment);


$post_content_html .= $post_content_treatment;

$blogContent = new BlogContent();

$blogContent->register($post_content_html, "paragraph", $id_post);