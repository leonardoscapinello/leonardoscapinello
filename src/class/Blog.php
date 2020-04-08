<?php

class Blog
{

    private $id_post;
    private $id_author;
    private $short_key;
    private $post_title;
    private $post_cover;
    private $version;
    private $insert_time;
    private $update_time;
    private $is_active;
    private $is_private;

    private $first_name;
    private $last_name;

    private $id_category;
    private $category_name;
    private $category_background;


    public function __construct($id_post = 0)
    {
        global $database;
        global $text;
        $database->query("SELECT * FROM blog b LEFT JOIN blog_categories bc ON bc.id_category = b.id_category LEFT JOIN (SELECT id_account, first_name, last_name FROM accounts WHERE is_customer = 'N') ac ON ac.id_account = b.id_author WHERE id_post = ? OR short_key = ?");
        $database->bind(1, $id_post);
        $database->bind(2, $id_post);
        $result = $database->resultsetObject();
        if ($result && count(get_object_vars($result)) > 0) {
            foreach ($result as $key => $value) {
                $this->$key = $text->utf8($value);
            }
        }
    }

    public function register($post_title, $id_category)
    {
        global $database;
        global $accounts;
        global $token;
        $id = array();
        try {

            if (not_empty($post_title) && strlen($post_title) > 3) {

                $post_title = htmlentities($post_title, ENT_NOQUOTES, "UTF-8", false);

                $id_account = $accounts->getIdAccount();
                $short_key = $token->tokenAlphanumeric(6);

                $database->query("INSERT INTO blog (id_author, short_key, post_title, id_category) VALUES (?,?,?,?)");
                $database->bind(1, $id_account);
                $database->bind(2, $short_key);
                $database->bind(3, $post_title);
                $database->bind(4, $id_category);
                $database->execute();

                $id = $database->lastInsertId();
                if ($id > 0) {
                    $id = array($id, $short_key);
                }

            }

        } catch (Exception $exception) {
            echo $exception;
            error_log($exception);
        }
        return $id;
    }

    public function uploadCover($post_cover, $id_post = 0)
    {
        global $database;
        global $text;
        try {
            $database->query("UPDATE blog SET post_cover = ? WHERE id_post = ?");
            $database->bind(1, $post_cover);
            $database->bind(2, $text->base64_decode($id_post));
            $database->execute();
        } catch (Exception $exception) {
            error_log($exception);
        }
    }

    public function getCategories()
    {
        global $database;
        try {
            $database->query("SELECT id_category, category_name FROM blog_categories WHERE is_active = 'Y'");
            $rs = $database->resultset();
            if (count($rs)) {
                return $rs;
            }
        } catch (Exception $exception) {
            error_log($exception);
        }
        return array();
    }

    public function getCategoryStamp()
    {
        global $text;
        return "<span class=\"stamp\" style=\"margin: 0;top: 0;background:" . $this->category_background . "\">" . $text->utf8($this->category_name) . "</span>";
    }

    public function getPostURL($return_only_title = false)
    {
        try {
            $u = new URL();

            if ($return_only_title) return $u->friendly($this->post_title);

            $url = BLOG . BLOG_POST_PAGE;
            $url = str_replace("{id}", $this->id_post, $url);
            $url = str_replace("{title}", $u->friendly($this->post_title), $url);
            return $url;
        } catch (Exception $exception) {
            error_log($exception);
        }
    }

    public function getEditURL()
    {
        try {
            return BLOG_ADMIN_EDIT_POST . "?id=" . $this->getIdPost() . "&post=" . $this->getShortKey();
        } catch (Exception $exception) {
            error_log($exception);
        }
    }

    /**
     * @return mixed
     */
    public function getIdPost()
    {
        return $this->id_post;
    }

    public function getAuthor()
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * @return mixed
     */
    public function getIdAuthor()
    {
        return $this->id_author;
    }

    /**
     * @return mixed
     */
    public function getShortKey()
    {
        return $this->short_key;
    }

    /**
     * @return mixed
     */
    public function getPostTitle()
    {
        return $this->post_title;
    }

    /**
     * @return mixed
     */
    public function getPostCover()
    {
        return $this->post_cover;
    }


    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return mixed
     */
    public function getInsertTime()
    {
        return $this->insert_time;
    }

    /**
     * @return mixed
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->is_active === "Y" ? true : false;
    }

    /**
     * @return mixed
     */
    public function getIsPrivate()
    {
        return $this->is_private === "Y" ? true : false;
    }


}