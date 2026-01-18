<?php

namespace SenderSolutions\Subscriber;

class Base
{
    public function __construct(
        private int $id = 0,
        private string $name = '',
    )
    {
    }

    public function toArray(): array
    {
        return [
            'Id' => $this->id,
            'Name' => $this->name,
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }
}
