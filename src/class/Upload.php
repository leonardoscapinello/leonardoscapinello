<?php

class Upload
{
    private $max_allowed_file_size = 20480; // size in KB
    private $allowed_extensions = array("png", "jpg", "jpeg", "gif", "bmp", "pdf");
    private $upload_folder = "../../../static/images/blog/uploads/";

    private $file = array();

    private function getBaseName()
    {
        return basename($this->file['name']);
    }

    private function getFileSize()
    {
        return basename($this->file['size']);
    }

    private function getFileType()
    {
        return substr($this->getBaseName(), strrpos($this->getBaseName(), '.') + 1);
    }

    private function getTempFolder()
    {
        return $temp_file = $this->file['tmp_name'];
    }

    private function checkForFileSize()
    {
        if (($this->getFileSize() / 1024) > $this->max_allowed_file_size) {
            return false;
        }
        return true;
    }

    private function checkForFormat()
    {
        $allowed_ext = false;
        for ($i = 0; $i < sizeof($this->allowed_extensions); $i++) {
            if (strcasecmp($this->allowed_extensions[$i], $this->getFileType()) === 0) {
                $allowed_ext = true;
            }
        }

        return $allowed_ext;
    }

    private function createNewFileName()
    {
        $token = new Token();
        return $token->tokenAlphanumeric(64) . "-" . $token::v4() . "." . $this->getFileType();
    }


    public function setFile($_FILE)
    {
        $this->file = $_FILE;
    }

    public function setUploadFolder(string $upload_folder)
    {
        $this->upload_folder = $upload_folder;
    }

    public function uploadFile()
    {
        try {
            $upload_folder = $this->upload_folder;
            $newfilename = $this->createNewFileName();
            $path_of_uploaded_file = $upload_folder . $newfilename;
            $temp = $this->getTempFolder();

            if (is_uploaded_file($temp)) {
                error_log('A1');
                if (copy($temp, $path_of_uploaded_file)) {
                    error_log('A2');
                    if (file_exists($path_of_uploaded_file)) {
                        error_log('A3');
                        return $newfilename;
                    }
                }
            }
        } catch (Exception $exception) {
            error_log($exception);
        }
        return false;
    }


}