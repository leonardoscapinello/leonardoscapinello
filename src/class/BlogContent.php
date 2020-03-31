<?php

class BlogContent
{

    private $id_blog;
    private $id_author;
    private $content;
    private $media_type;
    private $insert_time;
    private $is_active;


    public function register($post_content, $media_type, $id_blog, $alternative_text = null)
    {
        global $database;
        global $accounts;
        global $token;
        $id = 0;
        try {


            if (not_empty($post_content) && strlen($post_content) > 3) {

                $id_account = $accounts->getIdAccount();

                if ($media_type !== "video" || $media_type !== "image") $media_type = "paragraph";

                $html2TextConverter = new \Html2Text\Html2Text($post_content);

                $post_content = $html2TextConverter->getHtml();
                $post_content_clean = $html2TextConverter->getText();
                $post_content_clean_minified = str_replace(array("\r", "\n"), " ", $post_content_clean);

                $database->query("INSERT INTO blog_content (id_blog, id_author, content, content_clean, content_clean_minified, media_type, alternative_text) VALUES (?,?,?,?,?,?,?)");
                $database->bind(1, $id_blog);
                $database->bind(2, $id_account);
                $database->bind(3, $post_content);
                $database->bind(4, $post_content_clean);
                $database->bind(5, $post_content_clean_minified);
                $database->bind(6, $media_type);
                $database->bind(7, $alternative_text);
                $database->execute();

                $id = $database->lastInsertId();
                return $id;

            }

        } catch (Exception $exception) {
            error_log($exception);
        }
        return $id;
    }

    public function getAllByPost($id_blog)
    {

        global $database;
        global $accounts;
        $print_result = "";
        try {


            $database->query("SELECT content, media_type FROM blog_content WHERE id_blog = ? AND is_active = 'Y' ORDER BY order_number, insert_time ASC");
            $database->bind(1, $id_blog);
            $resultset = $database->resultset();


            for ($i = 0; $i < count($resultset); $i++) {
                $print_result .= $this->prepareContent($resultset[$i]['content'], $resultset[$i]['media_type']);
            }


        } catch (Exception $exception) {
            error_log($exception);
        }
        return $print_result;
    }

    private function prepareContent($content, $media_type)
    {
        if ($media_type === "paragraph") {
            $post_content_html = "<div class=\"blog--post-block blog-content--block\">";
            $post_content_html .= $content;
            $post_content_html .= "</div>";
        }


        return $post_content_html;
    }

}