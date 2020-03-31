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


    public function __construct($id_post = 0)
    {
        global $database;
        global $text;
        global $session;
        global $numeric;
        $database->query("SELECT * FROM blog WHERE id_post = ? OR short_key = ?");
        $database->bind(1, $id_post);
        $database->bind(2, $id_post);
        $result = $database->resultsetObject();
        if ($result && count(get_object_vars($result)) > 0) {
            foreach ($result as $key => $value) {
                $this->$key = $text->utf8($value);
            }
        }
    }

    public function register($post_title)
    {
        global $database;
        global $accounts;
        global $token;
        $id = array();
        try {

            if (not_empty($post_title) && strlen($post_title) > 3) {

                $id_account = $accounts->getIdAccount();
                $short_key = $token->tokenAlphanumeric(6);

                $database->query("INSERT INTO blog (id_author, short_key, post_title) VALUES (?,?,?)");
                $database->bind(1, $id_account);
                $database->bind(2, $short_key);
                $database->bind(3, $post_title);
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

    /**
     * @return mixed
     */
    public function getIdPost()
    {
        return $this->id_post;
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