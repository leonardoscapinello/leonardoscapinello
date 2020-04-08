<?php

class BlogSearch
{

    private $query;
    private $results;

    public function __construct($query_terms)
    {
        global $database;
        try {

            $query_terms = stringsafe($query_terms);
            $splited_terms = explode(" ", $query_terms);

            $query = "SELECT b.id_post, b.post_title, bc.content FROM blog b LEFT JOIN (SELECT GROUP_CONCAT(content_clean_minified) content, id_blog FROM blog_content WHERE media_type = 'paragraph' AND is_active = 'Y' GROUP BY id_blog) AS bc ON bc.id_blog = b.id_post WHERE b.is_published = 'Y' AND b.is_active = 'Y' AND bc.content IS NOT NULL ";

            $i = 0;
            foreach ($splited_terms as $each) {
                $i++;
                $query .= " AND (bc.content LIKE '%$each%'
                                OR b.post_title LIKE '%$each%'
                                OR SOUNDEX(bc.content) = SOUNDEX('$each')
                                OR SOUNDEX(b.post_title) = SOUNDEX('$each'))";
            }

            $query .= " LIMIT 20";


            $database->query($query);
            $result = $database->resultset();
            if (count($result) > 0) {
                $this->results = $result;
            }else{
                $this->results = array();
            }

        } catch (Exception $exception) {
            error_log($exception);
        }
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }


}