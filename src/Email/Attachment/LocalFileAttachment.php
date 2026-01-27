<?php

namespace SenderSolutions\Email\Attachment;

use InvalidArgumentException;

class LocalFileAttachment extends AbstractAttachment
{
    protected string $path;

    public function __construct(string $path)
    {
        if (!is_readable($path)) {
            throw new InvalidArgumentException('$path ' . $path . ' isn\'t readable');
        }
    }

    public function getContent(): string
    {
        return (string)file_get_contents($this->path);
    }
}
