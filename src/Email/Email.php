<?php

namespace SenderSolutions\Email;

use SenderSolutions\Email\Attachment\AttachmentDtoInterface;
use SenderSolutions\Email\EmailAddress\EmailAddressInterface;
use SenderSolutions\Email\Headers\EmailHeaderInterface;
use SenderSolutions\Email\Settings\EmailSettings;
use SenderSolutions\Email\Settings\TrackingSettings;

class Email implements EmailDtoInterface
{
    public TrackingSettings $trackingSettings;

    public EmailSettings $emailSettings;

    /**
     * @var EmailAddressInterface[]
     */
    private array $to = [];

    /**
     * @var EmailAddressInterface[]
     */
    private array $cc = [];

    /**
     * @var EmailAddressInterface[]
     */
    private array $bcc = [];

    /**
     * @var EmailAddressInterface[]
     */
    private array $replyTo = [];

    /**
     * @var AttachmentDtoInterface[]
     */
    private array $attachments = [];

    private string $subject = '';

    private string $plainText = '';

    private string $html = '';

    private EmailAddressInterface $from;

    /**
     * @var EmailHeaderInterface[]
     */
    private array $headers = [];

    public function __construct()
    {
        $this->trackingSettings = new TrackingSettings();
        $this->emailSettings = new EmailSettings();
    }

    public function setTrackingSettings(TrackingSettings $settings): static
    {
        $this->trackingSettings = $settings;
        return $this;
    }

    public function getTrackingSettings(): TrackingSettings
    {
        return $this->trackingSettings;
    }

    public function setTrackPlainTextLinks(?bool $trackPlainTextLinks): static
    {
        $this->trackingSettings->setTrackPlainTextLinks($trackPlainTextLinks);
        return $this;
    }

    public function setTrackLinks(?bool $trackLinks): static
    {
        $this->trackingSettings->setTrackLinks($trackLinks);
        return $this;
    }

    public function setTrackOpen(?bool $trackOpen): static
    {
        $this->trackingSettings->setTrackOpen($trackOpen);
        return $this;
    }

    public function setTrackUnsubscribe(?bool $trackUnsubscribe): static
    {
        $this->trackingSettings->setTrackUnsubscribe($trackUnsubscribe);
        return $this;
    }

    public function getEmailSettings(): EmailSettings
    {
        return $this->emailSettings;
    }

    public function setEmailSettings(EmailSettings $emailSettings): static
    {
        $this->emailSettings = $emailSettings;
        return $this;
    }

    public function toArray(): array
    {
        $extractAddress = static function (EmailAddressInterface $address): array {
            return [
                'Email' => $address->getEmail(),
                'Name'  => $address->getName(),
            ];
        };

        return [
            'TrackingSettings' => $this->trackingSettings->toArray(),
            'EmailSettings' => $this->emailSettings->toArray(),
            'Email' => [
                'To' => array_map($extractAddress, $this->to),
                'Cc' => array_map($extractAddress, $this->cc),
                'Bcc' => array_map($extractAddress, $this->bcc),
                'ReplyTo' => array_map($extractAddress, $this->replyTo),
                'From' => [
                    'Email' => $this->getFrom()->getEmail(),
                    'Name'  => $this->getFrom()->getName(),
                ],
                'Headers' => array_map(
                    static fn (EmailHeaderInterface $header): array => [
                        'Name'  => $header->getName(),
                        'Value' => $header->getValue(),
                    ],
                    $this->headers
                ),
                'Html' => $this->getHtml(),
                'PlainText' => $this->getPlainText(),
                'Subject' => $this->getSubject(),
                'Attachments' => array_map(
                    static fn (AttachmentDtoInterface $attachment): array => [
                        'ContentBase64' => base64_encode($attachment->getContent()),
                        'ContentId' => $attachment->getContentId(),
                        'Disposition' => $attachment->getDisposition(),
                        'Filename' => $attachment->getFilename(),
                        'Type' => $attachment->getType(),
                    ],
                    $this->attachments
                ),
            ],
        ];
    }

    public function setUseDkim(bool $useDkim): static
    {
        $this->emailSettings->setUseDkim($useDkim);
        return $this;
    }

    public function setUseDkimSelector(?string $useDkimSelector): static
    {
        $this->emailSettings->setUseDkimSelector($useDkimSelector);
        return $this;
    }

    public function setInlineImages(?bool $inlineImages): static
    {
        $this->emailSettings->setInlineImages($inlineImages);
        return $this;
    }

    public function setSendAt(?int $sendAt): static
    {
        $this->emailSettings->setSendAt($sendAt);
        return $this;
    }

    /**
     * @param EmailAddressInterface $emailAddress
     * @return $this
     */
    public function addTo(EmailAddressInterface $emailAddress): static
    {
        $this->to[] = $emailAddress;
        return $this;
    }

    /**
     * @param EmailAddressInterface $emailAddress
     * @return $this
     */
    public function addCc(EmailAddressInterface $emailAddress): static
    {
        $this->cc[] = $emailAddress;
        return $this;
    }

    /**
     * @param EmailAddressInterface $emailAddress
     * @return $this
     */
    public function addBcc(EmailAddressInterface $emailAddress): static
    {
        $this->bcc[] = $emailAddress;
        return $this;
    }

    /**
     * @param EmailAddressInterface $emailAddress
     * @return $this
     */
    public function addReplyTo(EmailAddressInterface $emailAddress): static
    {
        $this->replyTo[] = $emailAddress;
        return $this;
    }

    /**
     * @param AttachmentDtoInterface $attachment
     * @return $this
     */
    public function addAttachment(AttachmentDtoInterface $attachment): static
    {
        $this->attachments[] = $attachment;
        return $this;
    }

    /**
     * @param string $subject
     * @return $this
     */
    public function setSubject(string $subject): static
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setPlainText(string $text): static
    {
        $this->plainText = $text;
        return $this;
    }

    /**
     * @param string $html
     * @return $this
     */
    public function setHtml(string $html): static
    {
        $this->html = $html;
        return $this;
    }

    /**
     * @param EmailAddressInterface $emailAddress
     * @return $this
     */
    public function setFrom(EmailAddressInterface $emailAddress): static
    {
        $this->from = $emailAddress;
        return $this;
    }

    public function addCustomHeader(EmailHeaderInterface $header): static
    {
        $this->headers[] = $header;
        return $this;
    }

    /**
     * @return EmailAddressInterface[]
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @return EmailAddressInterface[]
     */
    public function getCc(): array
    {
        return $this->cc;
    }

    /**
     * @return EmailAddressInterface[]
     */
    public function getBcc(): array
    {
        return $this->bcc;
    }

    /**
     * @return EmailAddressInterface[]
     */
    public function getReplyTo(): array
    {
        return $this->replyTo;
    }

    /**
     * @return AttachmentDtoInterface[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getPlainText(): string
    {
        return $this->plainText;
    }

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @return EmailAddressInterface|null
     */
    public function getFrom(): ?EmailAddressInterface
    {
        if (!isset($this->from)) {
            throw new \LogicException('From address is not set');
        }

        return $this->from;
    }

    /**
     * @return EmailHeaderInterface[]
     */
    public function getCustomHeaders(): array
    {
        return $this->headers;
    }
}
