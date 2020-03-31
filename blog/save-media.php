<?php
require_once("../src/properties/index.php");
require_once("../src/public/validate.php");
$id_blog = get_request("id");
$media_type = get_request("media_type") === null ? "image" : get_request("media_type");
if ($id_blog === null) die("<span style=\"font-family:Arial, serif\">Não foi possível identificar a postagem referida. Tente novamente ou contacte o suporte técnico LS.<br /><br />suporte@flexwei.com<br /><br /><a href=\"#\" onClick=\"window.top.location.href = window.top.location.href.replace('add=image','').replace('add=media', '')\">Fechar</a></a></span>");


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

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enviar arquivo</title>
    <style type="text/css">
        html, body {
            overflow: hidden;
            width: calc(100% - 5px);
        }

        textarea {
            width: 100%;
            height: 130px;
            max-height: 130px;
            min-height: 130px;
            border: 1px #090508 solid;
        }

        input[type="file"] {
            margin-bottom: 20px;
        }

        .file {
            width: calc(100% - 4px);
            height: 80px;
            border: 1px #000 solid;
            border-radius: 4px;
            margin-bottom: 10px;
            position: relative;
            margin-right: 4px;
            margin-top: -40px;
        }

        .file i {
            font-size: 22px;
            position: absolute;
            top: calc(50% - 10px);
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #filename {
            position: absolute;
            left: 50%;
            bottom: 13px;
            transform: translate(-50%, 0);
            font-family: 'Arial', serif;
            font-size: 11px;
        }

        button {
            background: none;
            border: 1px #000000 solid;
            color: #000000;
            line-height: 32px;
            padding: 5px 22px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            font-weight: 600;
            font-size: .9em;
            -webkit-border-radius: 150px;
            -moz-border-radius: 150px;
            border-radius: 150px;
            min-width: 200px;
            transition: all .7s;
            cursor: pointer;
            margin: 12px auto;
        }

        [onClick] {
            cursor: pointer;
        }

        a {
            display: block;
            font-size: 13px;
            font-family: Arial, serif;
            color: #090508;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

    </style>
    <link href="<?= $static->getFileLocation("fontawesome.all.min.css") ?>" type="text/css" rel="stylesheet">
</head>
<body>
<form action="up" method="POST" enctype="multipart/form-data">
    <a href="#"
       onClick="window.top.location.href = window.top.location.href.replace('add=image','').replace('add=media', '').replace('&&', '')">Fechar
        janela e voltar</a>
    <input type="hidden" name="id" id="id" value="<?= $id_blog ?>"/>
    <input type="hidden" name="action" id="action" value="upload"/>
    <input type="file" name="attach_blog" id="attach_blog" style="opacity: 0" required>
    <div class="file" onClick="addFile();return false;">
        <i class="far fa-cloud-upload"></i>
        <div id="filename">clique para adicionar</div>
    </div>
    <textarea required name="alt_text" placeholder="Adicione uma breve descrição sobre esse arquivo."
              class=""></textarea>
    <div align="center">
        <button>Enviar</button>
    </div>
</form>
<script type="text/javascript">
    function addFile() {
        document.getElementById("attach_blog").click();
    }

    function getFileName() {
        var e = document.getElementById("attach_blog");
        var f = document.getElementById("filename");
        if (e.value !== null && e.value !== "") {
            var s = e.value.split("\\");
            f.innerHTML = s[(s.length - 1)];
        } else {
            f.innerHTML = "Clique para adicionar";
        }
    }

    window.setInterval(function () {
        getFileName();
    }, 300);
</script>
</body>
</html>