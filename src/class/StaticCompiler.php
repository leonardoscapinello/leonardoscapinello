<?php

class StaticCompiler
{

    private $files = array();
    private $replaces = array();
    private $output_file;
    private $date_reason = "dmYHis";

    public function add($location)
    {
        if (file_exists($location)) {
            array_push($this->files, $location);
        }
    }

    public function addReplace($search, $replace)
    {
        array_push($this->replaces, array($search, $replace));
    }

    public function setOutputFile($filename)
    {
        $this->output_file = $filename;
    }

    public function compileCSS()
    {
        $end_file = $this->output_file . ".min.css";
        $end_file_last_update = "";
        if (file_exists($end_file)) {
            $end_file_last_update = date($this->date_reason, filemtime($end_file));
        }
        $compile = false;
        for ($i = 0; $i < count($this->files); $i++) {
            $current_file_last_update = date($this->date_reason, filemtime($this->files[$i]));
            if ($end_file_last_update !== $current_file_last_update) {
                $file2_content = file_get_contents($this->files[$i]);
                $file2 = fopen($this->files[$i], "w") or die("Unable to open file!");
                fwrite($file2, $file2_content);
                fclose($file2);
                $compile = true;
            }
        }
        $buffer = "";
        if ($compile) {
            for ($i = 0; $i < count($this->files); $i++) {
                $buffer .= file_get_contents($this->files[$i]);
            }
            $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
            $buffer = str_replace(': ', ':', $buffer);
            $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

            if (count($this->replaces) > 0) {
                for ($x = 0; $x < count($this->replaces); $x++) {
                    $buffer = str_replace($this->replaces[$x][0], $this->replaces[$x][1], $buffer);
                }
            }

            $file = fopen($end_file, "w") or die("Unable to open file!");
            fwrite($file, $buffer);
            fclose($file);
        }

    }

    public function inlineCSS($file)
    {
        if (file_exists($file)) {
            return "<style type=\"text/css\">" . file_get_contents($file) . "</style>";
        }
    }

    public function minifyAndPrintInline($file)
    {
        if (file_exists($file)) {
            $buffer = "";
            $buffer .= file_get_contents($file);
            $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
            $buffer = str_replace(': ', ':', $buffer);
            $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
            if (count($this->replaces) > 0) {
                for ($x = 0; $x < count($this->replaces); $x++) {
                    $buffer = str_replace($this->replaces[$x][0], $this->replaces[$x][1], $buffer);
                }
            }
            return "<style type=\"text/css\">" . $buffer . "</style>";
        }
    }

    public function getFileLocation($filename)
    {
        return SITE_URL . "static/stylesheet/" . $filename;
    }

    public function getJSFileLocation($filename)
    {
        return SITE_URL . "static/javascript/" . $filename;
    }

    private function getImagePath_Address($filename, $campaign = null)
    {
        if ($filename === null || $filename === "") return null;
        if (not_empty($campaign)) {
            if ($campaign === "blog@cover") {
                return BLOG_COVER_PATH . $filename;
            } else {
                return SITE_URL . "c/" . $campaign . "/media/" . $filename;
            }
        }
        return SITE_URL . "static/images/" . $filename;

    }

    public function getImagePath($filename, $campaign = null)
    {
        $address = $this->getImagePath_Address($filename, $campaign);

        if ($address === null) return null;
        $filename = $address;
        $file_headers = @get_headers($filename);
        if (stripos($file_headers[0], "404 Not Found") > 0 || (stripos($file_headers[0], "302 Found") > 0 && stripos($file_headers[7], "404 Not Found") > 0)) {
            return null;
        } else {
            return $filename;
        }
    }


    public function getMoviePath($filename, $campaign = null)
    {
        if (not_empty($campaign)) {
            if ($campaign === "blog") {
                return SITE_URL . "m/blog/movie/" . $filename;
            }
        }
        return SITE_URL . "static/movie/" . $filename;

    }

}