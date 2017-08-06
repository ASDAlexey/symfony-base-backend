<?php

namespace AppBundle\Service;

class ImageService {
    protected $params;

    public function __construct($params) {
        $this->params = $params;
    }

    public function move($file) {
        if ($file) {
            // Generate a unique name for the file before saving it
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file to the directory where user avatars are stored
            $file->move($this->params['upload_destination'], $fileName);
        } else $fileName = null;
        return $fileName;
    }
}