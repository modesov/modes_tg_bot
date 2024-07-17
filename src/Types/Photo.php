<?php

namespace Modes\Bot\Types;

class Photo
{
    public string $fileId;
    public string $fileUniqueId;
    public int $fileSize;
    public int $width;
    public int $height;

    public function __construct(array $data)
    {
        $this->fileId = $data['file_id'];
        $this->fileUniqueId = $data['file_unique_id'];
        $this->fileSize = $data['file_size'];
        $this->width = $data['width'];
        $this->height = $data['height'];
    }
}