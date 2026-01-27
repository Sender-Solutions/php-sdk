<?php

namespace SenderSolutions\Email\Attachment;

abstract class AbstractAttachment implements AttachmentDtoInterface
{
    protected string $type;

    protected string $filename;

    protected string $disposition;

    protected string $contentId;

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function setDisposition(string $disposition): static
    {
        $this->disposition = $disposition;
        return $this;
    }

    public function setFilename(string $filename): static
    {
        $this->filename = $filename;
        return $this;
    }

    public function setContentId(string $contentId): static
    {
        $this->contentId = $contentId;
        return $this;
    }

    public function getType(): string
    {
        if (!isset($this->type)) {
            throw new \LogicException('Type for Attachment is not set');
        }
        return $this->type;
    }

    public function getDisposition(): string
    {
        if (!isset($this->disposition)) {
            throw new \LogicException('Disposition for Attachment is not set');
        }
        return $this->disposition;
    }

    public function getFilename(): string
    {
        if (!isset($this->filename)) {
            throw new \LogicException('Filename for Attachment is not set');
        }
        return $this->filename;
    }

    public function getContentId(): string
    {
        if (empty($this->contentId)) {
            $this->contentId = md5(
                $this->getContent() . $this->getType() . $this->getFilename()
            );
        }
        return $this->contentId;
    }
}
