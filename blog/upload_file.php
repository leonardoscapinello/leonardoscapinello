<?php
ignore_user_abort(true);
require_once("../src/properties/index.php");
require_once("../src/public/validate.php");
$id_blog = get_request("id");
$media_type = get_request("media_type") === null ? "image" : get_request("media_type");
if ($id_blog === null) die("<span style=\"font-family:Arial, serif\">Não foi possível identificar a postagem referida. Tente novamente ou contacte o suporte técnico LS.<br /><br />suporte@flexwei.com<br /><br /><a href=\"#\" onClick=\"window.top.location.href = window.top.location.href.replace('add=image','')\">Fechar</a></a></span>");


if (get_request("action") === "upload") {

    $upload = new Upload();
    $upload->setUploadFolder(DIRNAME . "../../static/images/blog/uploads/");
    $upload->setFile($_FILES['attach_blog']);
    $filename = $upload->uploadFile();
    $alternative_text = get_request("alt_text");
    if (notempty($filename)) {
        $blogContent = new BlogContent();
        $blogContent->register($filename, $media_type, $text->base64_decode($id_blog), $alternative_text);
    }
}
header("location: ./up/processing");
?>


