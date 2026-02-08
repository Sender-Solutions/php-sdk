<?php

namespace SenderSolutions\Suppression;

class Suppression
{
    public function __construct(
        private int $Id,
        private int $BaseId,
        private string $Email,
        private string $Type,
        private int $CreatedAt,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'Id' => $this->Id,
            'BaseId' => $this->BaseId,
            'Email' => $this->Email,
            'Type' => $this->Type,
            'CreatedAt' => $this->CreatedAt,
        ];
    }

    public static function fromJsonResponse(array $suppressionData): Suppression
    {
        return new Suppression(
            $suppressionData['Id'],
            $suppressionData['BaseId'],
            $suppressionData['Email'],
            $suppressionData['Type'],
            $suppressionData['CreatedAt']
        );
    }

    public function getId(): int
    {
        return $this->Id;
    }

    public function getBaseId(): int
    {
        return $this->BaseId;
    }

    public function getEmail(): string
    {
        return $this->Email;
    }

    public function getType(): string
    {
        return $this->Type;
    }

    public function getCreatedAt(): int
    {
        return $this->CreatedAt;
    }
}
