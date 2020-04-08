<?php

require_once("../properties/index.php");
$query = get_request("q");

$blogWidget = new BlogWidget();
$blogSearch = new BlogSearch($query);

$results = (array)($blogSearch->getResults());
if (count($results)) {
    for ($i = 0; $i < count($results); $i++) {

        $blogSearchItem = new Blog($results[$i]['id_post']);
        $date->setCustomDateFormat("m/y");
        $img = $static->getImagePath($blogSearchItem->getPostCover(), "blog@cover");

        ?>

        <a href="<?= $blogWidget->url($results[$i]['id_post'], $results[$i]['post_title']) ?>">
            <div class="result h">
                <?php if ($img) { ?>
                    <div class="background">
                        <img src="<?= $static->getImagePath($blogSearchItem->getPostCover(), "blog@cover") ?>"
                             alt="<?= $blogSearchItem->getPostTitle() ?>"/>
                    </div>
                <?php } ?>
                <div class="post-title">
                    <?= $blogSearchItem->getPostTitle() ?>
                </div>
                <div class="post-category">
                    <?= $blogSearchItem->getCategoryStamp() ?><span
                            class="author">Por <?= $blogSearchItem->getAuthor() ?> em <?= $date->formatDate($blogSearchItem->getInsertTime()) ?></span>
                </div>
            </div>
        </a>
    <?php } ?>
<?php } else { ?>

    <div class="result">
        <div class="post-title text center"><i class="far fa-books"></i>
            <p class="text center"><span class="big-text">Lamento.</span><br/> Eu revirei tudo o que há escrito por
                aqui e não achei nada parecido com o que você procura.</p><p class="text center">Assine nossa Lista VIP para receber todo o conteúdo que escrevemos.</p></div>
    </div>
<?php } ?>
