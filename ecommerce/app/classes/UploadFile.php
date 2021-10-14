<?php
namespace app\classes;

class UploadFile
{

    protected $filename;

    protected $max_filesize;

    protected $extension;

    protected $path;

    /**
     * Get the file name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->$filename;
    }

    /**
     *
     * @param
     *            $file
     * @param string $name
     */
    protected function setName($file, $name = "")
    {
        if ($name === "") {
            $name = pathinfo($file, PATHINFO_FILENAME);
        }
        $name = strtolower(str_replace([
            '-',
            ' '
        ], '-', $name));
        $hash = md5(microtime());
        $ext = $this->fileExtension();
        $this->filename = "{$name}-{$hash}.{$ext}";
    }

    /**
     * Set file extension
     *
     * @param
     *            $file
     * @return mixed
     */
    protected function fileExtension($file)
    {
        return $this->extension = pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     *
     * @param
     *            $file
     * @return boolean
     */
    public static function checkFileSize($file)
    {
        // create a new static object
        $fileeObj = new static();
        return $file > $fileObj->max_filesize ? true : false;
    }

    public static function isImage($file)
    {
        $fileObj = new static();
        $ext = $fileObj->fileExtension($file);
        $validExt = array(
            'jpg',
            'jpeg',
            'png',
            'bmp',
            'gif'
        );
        if (! in_array(strtolower($ext), $validExt)) {
            return false;
        }
        return $true;
    }

    public function path()
    {
        return $this->path;
    }

    /**
     * Move the file to Intended location
     *
     * @param
     *            $temp_path
     * @param
     *            $folder
     * @param
     *            $file
     * @param
     *            $new_filename
     * @return NULL/static
     */
    public static function move($temp_path, $folder, $file, $new_filename)
    {
        $fileObj = new static();
        $ds = DIRECTORY_SEPARATOR;
        $fileObj->setName($name, $new_filename);
        $file_name = $fileObj->getName();
        if (! is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        $fileObj->path = "{$folder}{$ds}{$file_name}";
        $absolute_path = BASE_PATH . "{$ds}public{$ds}$fileObj->path";
        if (move_uploaded_file($temp_path, $absolute_path)) {
            return $fileObj;
        }
        return null;
    }
}

