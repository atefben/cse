<?php
/**
 * Created by PhpStorm.
 * User: devmachine
 * Date: 07/02/17
 * Time: 14:20
 */

namespace AppBundle\Handlers;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploadHandler
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->targetDir, $fileName);

        return $fileName;
    }
}
