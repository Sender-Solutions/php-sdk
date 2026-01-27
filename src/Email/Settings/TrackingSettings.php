<?php

namespace SenderSolutions\Email\Settings;

class TrackingSettings
{
    public function __construct(
        private ?bool $trackLinks = null,
        private ?bool $trackPlainTextLinks = null,
        private ?bool $trackOpen = null,
        private ?bool $trackUnsubscribe = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'TrackLinks' => $this->trackLinks,
            'TrackPlainTextLinks' => $this->trackPlainTextLinks,
            'TrackOpen' => $this->trackOpen,
            'TrackUnsubscribe' => $this->trackUnsubscribe,
        ];
    }

    public function getTrackPlainTextLinks(): ?bool
    {
        return $this->trackPlainTextLinks;
    }

    public function setTrackPlainTextLinks(?bool $trackPlainTextLinks): static
    {
        $this->trackPlainTextLinks = $trackPlainTextLinks;
        return $this;
    }

    public function getTrackLinks(): ?bool
    {
        return $this->trackLinks;
    }

    public function setTrackLinks(?bool $trackLinks): static
    {
        $this->trackLinks = $trackLinks;
        return $this;
    }

    public function getTrackOpen(): ?bool
    {
        return $this->trackOpen;
    }

    public function setTrackOpen(?bool $trackOpen): static
    {
        $this->trackOpen = $trackOpen;
        return $this;
    }

    public function getTrackUnsubscribe(): ?bool
    {
        return $this->trackUnsubscribe;
    }

    public function setTrackUnsubscribe(?bool $trackUnsubscribe): static
    {
        $this->trackUnsubscribe = $trackUnsubscribe;
        return $this;
    }
}
