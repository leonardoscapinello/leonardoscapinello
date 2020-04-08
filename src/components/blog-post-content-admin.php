<?php
$add = get_request("add");
$disabled = false;
if ($add !== null) $disabled = true;


?>

<section>
    <div class="blog-post">
        <div class="post-content">

            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-sm-12">
                        <div class="content-blog">


                            <?php
                            $blogContent = new BlogContent();
                            echo $blogContent->getAllByPost($id, true);
                            ?>


                            <?php
                            // IF ID PARAGRAPH IS ZERO, CREATE A NEW ONE, ELSE EDIT.
                            if ($add === "paragraph" && $id_paragraph === "0") { ?>
                                <div class="blog--post-block edit-enabled" data-editable
                                     data-name="paragraph-element" id="P0"></div>
                            <?php } elseif ($add === "video" || $add === "image" || $add === "cover") { ?>
                                <div class="blog--modal-add">
                                    <iframe src="<?= BLOG_ADMIN_ADD_MEDIA ?>?id=<?= $text->base64_encode($id) ?>&media_type=<?= $add ?>"
                                            class="frame-full" scrolling="no" style="overflow: hidden"></iframe>
                                </div>
                            <?php } ?>

                            <div class="add_text_widget">
                                <ul>
                                    <li <?= $disabled === false ? "tooltip=\"Adicionar Paragrafo\" flow=\"right\" onClick=\"add('paragraph');\"" : "class=\"disabled\"" ?>>
                                        <a style="cursor: pointer;margin-left: 8px">
                                            <i class="far fa-paragraph"></i>
                                        </a>
                                    </li>
                                    <li <?= $disabled === false ? "tooltip=\"Adicionar Imagem\" flow=\"right\" onClick=\"add('image');\"" : "class=\"disabled\"" ?> >
                                        <a style="cursor: pointer;"><i class="far fa-image"></i></a>
                                    </li>
                                    <li <?= $disabled === false ? "tooltip=\"Adicionar Vídeo\" flow=\"right\" onClick=\"add('video');\"" : "class=\"disabled\"" ?> >
                                        <a style="cursor: pointer;"><i class="far fa-camera-movie"></i></a>
                                    </li>
                                    <li style="display:none" <?= $disabled === false ? "tooltip=\"Adicionar Citação\" flow=\"right\"" : "class=\"disabled\"" ?> >
                                        <a href="#"><i class="far fa-quote-right"></i></a>
                                    </li>
                                </ul>
                            </div>

                            <?php if ($add === "paragraph") { ?>
                                <div class="ct-custom-save">
                                    <ul>
                                        <li tooltip="Salvar Alterações" flow="right" onClick="save();return false;">
                                            <a  style="cursor: pointer;">
                                                <i class="far fa-check"></i>
                                            </a>
                                        </li>
                                        <li tooltip="Encerrar Edição" flow="right"
                                            onClick="discard();return false;">
                                            <a href="<?= $url->removeQueryString("add") ?>"
                                               style="cursor: pointer;">
                                                <i class="far fa-times"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php } ?>


                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>
</section>

<?php
$url->setCustomUrl($url->getActualURL());
$edit_url = $url->removeQueryString(array("add", "paragraph"));
?>

<?php if ($add === "paragraph") { ?>
    <script type="text/javascript">

        function discard() {
            window.location.href = "<?= $url->removeQueryString(array("add", "paragraph")) ?>";
        }

        function save() {
            editor.save(true);
        }

        let editor;
        let toolbox;
        window.addEventListener('load', function () {
            editor = ContentTools.EditorApp.get();
            <?php if ($id_paragraph === null || $id_paragraph === "0") { ?>
            editor.init('*[data-editable]');
            <?php } else{ ?>
            editor.init('*[data-paragraph="<?=$id_paragraph?>"]');
            $('*[data-paragraph="<?=$id_paragraph?>"]').addClass("blog--post-block");
            $('*[data-paragraph="<?=$id_paragraph?>"]').addClass("edit-enabled");
            <?php } ?>
            ContentTools.Tools.Heading.tagName = 'h3';
            ContentTools.Tools.Subheading.tagName = 'h4';
            editor.start();


            window.removeEventListener('beforeunload', editor._handleBeforeUnload);

            editor.addEventListener('saved', function (ev) {
                var name, payload, regions, xhr;
                regions = ev.detail().regions;
                if (Object.keys(regions).length == 0) {
                    return;
                }
                this.busy(true);
                payload = new FormData();
                for (name in regions) {
                    if (regions.hasOwnProperty(name)) {
                        payload.append(name, regions[name]);
                    }
                }


                payload.append("id_post", "<?=$id?>");
                payload.append("id_paragraph", "<?=$id_paragraph?>");

                function onStateChange(ev) {
                    if (ev.target.readyState == 4) {
                        editor.busy(false);
                        if (ev.target.status == '200') {
                            new ContentTools.FlashUI('ok');
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {

                            new ContentTools.FlashUI('no');
                        }
                    }
                }

                xhr = new XMLHttpRequest();
                xhr.addEventListener('readystatechange', onStateChange);
                xhr.open('POST', '<?=BLOG_ADMIN_SAVE_PARAGRAPH?>');
                xhr.send(payload);
            });

        });

    </script>
<?php } ?>
<script type="text/javascript">


    function edit(id) {
        if (id === <?=$id_paragraph?>) return false;
        window.location.href = "<?= $url->removeQueryString(array("add", "paragraph")) ?>&add=paragraph&paragraph=" + id + "#P" + id;
    }


    function add(d) {
        if (d === "paragraph") {
            window.location.href = "<?= $url->addQueryString(array("add" => "paragraph")) ?>";
        }
        if (d === "image") {
            window.location.href = "<?= $url->addQueryString(array("add" => "image")) ?>";
        }
        if (d === "video") {
            window.location.href = "<?= $url->addQueryString(array("add" => "video")) ?>";
        }
        if (d === "cover") {
            window.location.href = "<?= $url->addQueryString(array("add" => "cover")) ?>";
        }
    }
</script>
