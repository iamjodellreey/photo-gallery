<?php

class Photo extends DatabaseService
{
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;
    public $date;
    public $tmpPath;
    public $uploadDir = "img";
    public $errors = [];
    public $uploadErrors = [
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    ];

    protected static $tableName = "photos";
    protected static $tableFields = ['id', 'title', 'description', 'filename', 'type', 'size', 'date'];

    public function setFile($file)
    {
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There was no file uploaded";
            return false;
        } elseif ($file['error'] != 0) {
            $this->errors[] = $this->uploadErrors[$file['error']];
            return false;
        } else {
            $this->filename = basename($file['name']);
            $this->type = $file['type'];
            $this->size = $file['size'];
            $this->tmpPath = $file['tmp_name'];
            $this->date = date("Y/m/d");
        }
    }

    public function picturePath()
    {
        return $this->uploadDir . DS . $this->filename;
    }

    public function deletePhoto()
    {
        if ($this->delete()) {
            $targetPath = SITE_ROOT . DS . 'admin' . DS . $this->picturePath();
            return unlink($targetPath) ? true : false;
        } else {
            return false;
        }
    }

    public function savePhoto()
    {

        $targetPath = SITE_ROOT . DS . 'admin' . DS . $this->picturePath();

        if ($this->id) {
            $this->update();
            if (move_uploaded_file($this->tmpPath, $targetPath)) {
                unset($this->tmpPath);
                return true;
            };
            return true;
        } else {
            if (!empty($this->errors)) {
                return false;
            }
            if (empty($this->filename) || empty($this->tmpPath)) {
                $this->errors[] = "File was not available";
                return false;
            }

            if (file_exists($this->filename)) {
                $this->errors[] = "This file {$this->filename} already exists";
            }

            if (move_uploaded_file($this->tmpPath, $targetPath)) {
                if ($this->create()) {
                    unset($this->tmpPath);
                    return true;
                }
            } else {
                $this->errors[] = "File directory does not have permission";
                return false;
            }
        }
    }
}
