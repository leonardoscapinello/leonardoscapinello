<?php
ignore_user_abort(true);
require_once("../src/properties/index.php");
require_once("../src/public/validate-admin.php");


$id_blog = get_request("id");
$media_type = get_request("media_type") === null ? "image" : get_request("media_type");
if ($id_blog === null) die("<span style=\"font-family:Arial, serif\">Não foi possível identificar a postagem referida. Tente novamente ou contacte o suporte técnico LS.<br /><br />suporte@flexwei.com<br /><br /><a href=\"#\" onClick=\"window.top.location.href = window.top.location.href.replace('add=image','')\">Fechar</a></a></span>");
$errorMsg = "";

if (get_request("action") === "upload") {

    $upload = new Upload();
    $upload->setFile($_FILES['attach_blog']);
    $alternative_text = get_request("alt_text");

    if ($media_type === "cover") {

        $upload->setUploadFolder(DIRNAME . "../../static/uploads/blog/cover/");
        $upload_result = $upload->uploadFile();
        if ($upload_result[0]) {
            $filename = $upload_result[1];
            if (notempty($filename)) {
                $blogPost = new Blog();
                $blogPost->uploadCover($filename, $id_blog);
            }
        } else {
            header("location: ./up/processing?media=" . $media_type . "&id=" . $id_blog . "&error=" . $text->base64_encode($upload_result[1]));
            die;
        }

    } else {

        $upload->setUploadFolder(DIRNAME . "../../static/uploads/blog/");
        $upload_result = $upload->uploadFile();
        if ($upload_result[0]) {
            $filename = $upload_result[1];
            if (notempty($filename)) {
                $blogContent = new BlogContent();
                $blogContent->register($filename, $media_type, $text->base64_decode($id_blog), $alternative_text);
            }
        } else {
            header("location: ./up/processing?media=" . $media_type . "&id=" . $id_blog . "&error=" . $text->base64_encode($upload_result[1]));
            die;
        }

    }

}
header("location: ./up/processing?media=" . $media_type);
?>


