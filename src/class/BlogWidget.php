<?php

class BlogWidget
{

    private $id_blog;
    private $id_author;
    private $content;
    private $media_type;
    private $insert_time;
    private $is_active;


    public function getFeatured($limit = 10, $id_category = 0)
    {
        global $database;
        global $accounts;
        $print_result = "";
        try {

            $filter_cat = "";
            if ($id_category > 0) $filter_cat = " AND b.id_category = ? ";

            $database->query("SELECT b.id_post, b.post_title, b.post_cover, bc.category_name, bc.category_background FROM blog b LEFT JOIN blog_categories bc ON bc.id_category = b.id_category WHERE b.is_active = 'Y' AND bc.is_active = 'Y' AND b.is_published = 'Y' " . $filter_cat . " ORDER BY b.insert_time DESC LIMIT " . $limit);
            if ($id_category > 0) $database->bind(1, $id_category);
            $resultset = $database->resultset();
            for ($i = 0; $i < count($resultset); $i++) {
                $print_result .= $this->widget($resultset[$i]['id_post'], $resultset[$i]['post_title'], $resultset[$i]['post_cover'], $resultset[$i]['category_name'], $resultset[$i]['category_background']);
            }
        } catch (Exception $exception) {
            error_log($exception);
        }
        return $print_result;
    }

    private function widget($id_post, $post_title, $post_cover, $category_name, $category_background)
    {
        global $text;
        global $static;
        try {

            $widget = "";
            $cover = $static->getImagePath($post_cover, "blog@cover");
            if ($cover !== null && $cover !== "") {
                $widget .= "<div class=\"blog-post--widget\">";
                $widget .= "	<div class=\"background\">";
                $widget .= "        <img src=\"" . $cover . "\" alt=\"Background\"/>";
                $widget .= "    </div>";
                $widget .= "    <a href=\"" . $this->url($id_post, $post_title) . "\">";
                $widget .= "        <div class=\"post-info\">";
                $widget .= "            <div class=\"content\">";
                $widget .= "                <div class=\"stamp\" style=\"background:" . $category_background . "\">" . $category_name . "</div>";
                $widget .= "                <h5>" . $text->utf8($post_title) . "</h5>";
                $widget .= "                <span class=\"readmore\">Ler Postagem</span>";
                $widget .= "            </div>";
                $widget .= "        </div>";
                $widget .= "    </a>";
                $widget .= "</div>";
            }

            return $widget;

        } catch (Exception $exception) {
            error_log($exception);
        }
    }


    public function url($id_post, $post_title)
    {
        try {
            $u = new URL();
            $url = BLOG . BLOG_POST_PAGE;
            $url = str_replace("{id}", $id_post, $url);
            $url = str_replace("{title}", $u->friendly($post_title), $url);
            return $url;
        } catch (Exception $exception) {
            error_log($exception);
        }
    }

}