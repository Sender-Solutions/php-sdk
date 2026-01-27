<?php

namespace SenderSolutions\Email\Attachment;

class StringAttachment extends AbstractAttachment
{
    public function __construct(
        protected string $content
    )
    {
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
