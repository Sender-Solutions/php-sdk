<?php

namespace SenderSolutions\Email\Settings;

class EmailSettings
{
    public function __construct(
        private bool $useDkim = true,
        private ?string $useDkimSelector = null,
        private ?bool $inlineImages = null,
        private ?int $sendAt = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'InlineImages' => $this->inlineImages,
            'SendAt' => $this->sendAt,
            'UseDkim' => $this->useDkim,
            'UseDkimSelector' => $this->useDkimSelector,
        ];
    }

    public function isUseDkim(): bool
    {
        return $this->useDkim;
    }

    public function setUseDkim(bool $useDkim): static
    {
        $this->useDkim = $useDkim;
        return $this;
    }

    public function getUseDkimSelector(): ?string
    {
        return $this->useDkimSelector;
    }

    public function setUseDkimSelector(?string $useDkimSelector): static
    {
        $this->useDkimSelector = $useDkimSelector;
        return $this;
    }

    public function getInlineImages(): ?bool
    {
        return $this->inlineImages;
    }

    public function setInlineImages(?bool $inlineImages): static
    {
        $this->inlineImages = $inlineImages;
        return $this;
    }

    public function getSendAt(): ?bool
    {
        return $this->sendAt;
    }

    public function setSendAt(?int $sendAt): static
    {
        $this->sendAt = $sendAt;
        return $this;
    }
}
