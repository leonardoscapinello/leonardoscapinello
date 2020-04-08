<?php

class Pages
{

    private $id_page;
    private $title;
    private $description;
    private $keywords;
    private $thumb;
    private $url;
    private $content;
    private $is_active;
    private $expire_date;
    private $fb_pixel;
    private $fb_pixel_track;
    private $ga_tracker_id;
    private $ga_tagmanager;

    public function __construct($id_page = 1)
    {
        global $database;
        global $text;
        try {
            $database->query("SELECT * FROM pages WHERE id_page = :page OR url = :page");
            $database->bind(":page", $id_page);
            $result = $database->resultsetObject();
            if ($result && count(get_object_vars($result)) > 0) {
                foreach ($result as $key => $value) {
                    $this->$key = $text->utf8($value);
                }
            }
        } catch (Exception $exception) {
            error_log($exception);
        }
    }

    /**
     * @return mixed
     */
    public function getIdPage()
    {
        return $this->id_page;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @return mixed
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * @return mixed
     */
    public function getExpireDate()
    {
        return $this->expire_date;
    }

    /**
     * @return mixed
     */
    public function getFacebookPixelKey()
    {
        return $this->fb_pixel;
    }

    /**
     * @return mixed
     */
    public function getFacebookPixelTrackName()
    {
        return $this->fb_pixel_track;
    }

    /**
     * @return mixed
     */
    public function getGoogleAnalyticsKey()
    {
        return $this->ga_tracker_id;
    }

    /**
     * @return mixed
     */
    public function getGoogleTagManagerKey()
    {
        return $this->ga_tagmanager;
    }


}