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

                if ($media_type !== "video" && $media_type !== "image") $media_type = "paragraph";

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

    public function update($post_content, $id_content = 0)
    {
        global $database;
        global $accounts;
        global $token;
        $id = 0;
        try {

            if (not_empty($post_content) && strlen($post_content) > 5) {
                $id_account = $accounts->getIdAccount();
                $html2TextConverter = new \Html2Text\Html2Text($post_content);

                $post_content = $html2TextConverter->getHtml();
                $post_content_clean = $html2TextConverter->getText();
                $post_content_clean_minified = str_replace(array("\r", "\n"), " ", $post_content_clean);

                $database->query("UPDATE blog_content SET id_author = ?, content = ?, content_clean = ?, content_clean_minified = ? WHERE id_content = ?");
                $database->bind(1, $id_account);
                $database->bind(2, $post_content);
                $database->bind(3, $post_content_clean);
                $database->bind(4, $post_content_clean_minified);
                $database->bind(5, $id_content);
                $database->execute();
                $id = $id_content;

            } else {
                $database->query("UPDATE blog_content SET is_active = 'N' WHERE id_content = ?");
                $database->bind(1, $id_content);
                $database->execute();
                $id = $id_content;
            }

        } catch (Exception $exception) {
            error_log($exception);
        }
        return $id;
    }

    public function getAllByPost($id_blog, $edit = false)
    {
        global $database;
        global $accounts;
        $print_result = "";
        try {
            $database->query("SELECT id_content, content, media_type, alternative_text FROM blog_content WHERE id_blog = ? AND is_active = 'Y' ORDER BY order_number, insert_time ASC");
            $database->bind(1, $id_blog);
            $resultset = $database->resultset();
            for ($i = 0; $i < count($resultset); $i++) {
                if ($edit) {
                    $print_result .= $this->prepareContent($resultset[$i]['content'], $resultset[$i]['media_type'], $resultset[$i]['alternative_text'], $resultset[$i]['id_content']);
                } else {
                    $print_result .= $this->prepareContent($resultset[$i]['content'], $resultset[$i]['media_type'], $resultset[$i]['alternative_text'], false);
                }
            }
        } catch (Exception $exception) {
            error_log($exception);
        }
        return $print_result;
    }

    private function prepareContent($content, $media_type, $alternative_text = null, $id_paragraph_for_edit = false)
    {
        $edit_script = "";
        if ($media_type === "paragraph") {
            if ($id_paragraph_for_edit) $edit_script = "onClick=\"edit(" . $id_paragraph_for_edit . ");return false;\" data-paragraph=\"" . $id_paragraph_for_edit . "\" id=\"P" . $id_paragraph_for_edit . "\"";
            $post_content_html = "<div class=\"blog--post-block blog-content--block\" " . $edit_script . ">";
            $post_content_html .= $content;
            $post_content_html .= "</div>";
        }
        if ($media_type === "image") {

            $content = BLOG_UPLOADED_FILES_PATH . $content;
            $html2TextConverter = new \Html2Text\Html2Text($alternative_text);

            $alternative_text = $html2TextConverter->getText();

            $post_content_html = "<figure class='blog--post-figure'>";
            $post_content_html .= "<img src=\"" . $content . "\" alt=\"" . $alternative_text . "\">";
            $post_content_html .= "</figure>";
        }
        if ($media_type === "video") {
            $content = BLOG_UPLOADED_FILES_PATH . $content;
            $post_content_html = "<div class=\"blog--post-video\">";
            $post_content_html .= "   <div class=\"ls-player-container half-player\">";
            $post_content_html .= "      <video poster=\"" . $content . "\" class=\"ls-player \">";
            $post_content_html .= "         <source src=\"" . $content . "\" type=\"video/mp4\"/>";
            $post_content_html .= "      </video>";
            $post_content_html .= "   </div>";
            $post_content_html .= "</div>";
        }


        return $post_content_html;
    }

}