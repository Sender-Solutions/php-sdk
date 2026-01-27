<?php

namespace SenderSolutions\Email\Attachment;

interface AttachmentDtoInterface
{
    const DISPOSITION_ATTACHMENT = 'attachment';

    const DISPOSITION_INLINE = 'inline';

    public function getContent(): string;

    public function getType(): string;

    public function getDisposition(): string;

    public function getFilename(): string;

    public function getContentId(): string;

    public function setContentId(string $contentId): static;

    public function setDisposition(string $disposition): static;

    public function setFilename(string $filename): static;

    public function setType(string $type): static;
}
