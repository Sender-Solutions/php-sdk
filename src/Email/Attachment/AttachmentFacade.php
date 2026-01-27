<?php

namespace SenderSolutions\Email\Attachment;

class AttachmentFacade
{
    public static function createFromPath(string $path): AttachmentDtoInterface
    {
        return (new LocalFileAttachment($path))->setDisposition(AttachmentDtoInterface::DISPOSITION_ATTACHMENT);
    }

    public static function createInlineFromPath(string $path): AttachmentDtoInterface
    {
        return (new LocalFileAttachment($path))->setDisposition(AttachmentDtoInterface::DISPOSITION_INLINE);
    }

    public static function createFromString(string $content, string $filename, string $content_type): AttachmentDtoInterface
    {
        return (new StringAttachment($content))
            ->setFilename($filename)
            ->setType($content_type)
            ->setDisposition(AttachmentDtoInterface::DISPOSITION_ATTACHMENT)
        ;
    }

    public static function createInlineFromString(string $content, string $filename, string $content_type): AttachmentDtoInterface
    {
        return (new StringAttachment($content))
            ->setFilename($filename)
            ->setType($content_type)
            ->setDisposition(AttachmentDtoInterface::DISPOSITION_INLINE)
        ;
    }
}
