<?php

namespace SenderSolutions\Email\Headers;

class EmailHeader implements EmailHeaderInterface
{
    public function __construct(
        private string $name,
        private string $value
    )
    {
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
