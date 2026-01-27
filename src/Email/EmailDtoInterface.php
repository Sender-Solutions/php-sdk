<?php

namespace SenderSolutions\Email;

use SenderSolutions\Email\Attachment\AttachmentDtoInterface;
use SenderSolutions\Email\EmailAddress\EmailAddressInterface;
use SenderSolutions\Email\Headers\EmailHeaderInterface;
use SenderSolutions\Email\Settings\EmailSettings;
use SenderSolutions\Email\Settings\TrackingSettings;

interface EmailDtoInterface
{
    public function addTo(EmailAddressInterface $emailAddress): static;
    public function addCc(EmailAddressInterface $emailAddress): static;
    public function addBcc(EmailAddressInterface $emailAddress): static;
    public function addReplyTo(EmailAddressInterface $emailAddress): static;
    public function addAttachment(AttachmentDtoInterface $attachment): static;
    public function setSubject(string $subject): static;
    public function setPlainText(string $text): static;
    public function setHtml(string $html): static;
    public function setFrom(EmailAddressInterface $emailAddress): static;

    public function addCustomHeader(EmailHeaderInterface $header): static;

    public function toArray(): array;

    /**
     * @return EmailAddressInterface[]
     */
    public function getTo(): array;

    /**
     * @return EmailAddressInterface[]
     */
    public function getCc(): array;

    /**
     * @return EmailAddressInterface[]
     */
    public function getBcc(): array;

    /**
     * @return EmailAddressInterface[]
     */
    public function getReplyTo(): array;

    /**
     * @return AttachmentDtoInterface[]
     */
    public function getAttachments(): array;

    public function getSubject(): string;

    public function getPlainText(): string;

    public function getHtml(): string;

    public function getFrom(): ?EmailAddressInterface;

    /**
     * @return EmailHeaderInterface[]
     */
    public function getCustomHeaders(): array;

    public function setTrackingSettings(TrackingSettings $settings): static;

    public function getTrackingSettings(): TrackingSettings;

    public function setEmailSettings(EmailSettings $emailSettings): static;

    public function getEmailSettings(): EmailSettings;
}
