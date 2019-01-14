<?php
namespace Safe\Validator;

use Safe\System\Utilities;

class Validate
{
    protected $mimeType;

    protected $fileSize;

    protected $utilities;

    public $errorMessage = array();

    public function __construct()
    {
        $this->fileSize = new FileSize();

        $this->mimeType = new MimeType();

        $this->utilities = new Utilities();
    }

    /**
     * @param FileSize $fileSize
     */
    public function setFileSize(FileSize $fileSize): void
    {
        $this->fileSize = $fileSize;
    }

    /**
     * @param MimeType $mimeType
     */
    public function setMimeType(MimeType $mimeType): void
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @param $file
     * @return bool
     */
    public function upload($file){
        if ($file['error'] != 0){
            $this->getErrorMessage($file);
            return false;
        }
        return true;
    }

    /**
     * @param $file
     * @return mixed
     */
    protected function getErrorMessage($file){
        switch ($file['error']){
            case 1:
            case 2:
                $this->errorMessage[] = $file['name'] . ' is to big (max: '.
                    $this->utilities::convertFromBytes($this->fileSize->getMaxSize()) .').';
                break;
            case 3:
                $this->errorMessage[] = $file['name'] . 'was only partially uploaded.';
                break;
            case 4:
                $this->errorMessage[] = 'No file submitted.';
                break;
            default:
                $this->errorMessage[] = 'Sorry there was a problem uploading' . $file['name'];
                break;
        }
    }

}