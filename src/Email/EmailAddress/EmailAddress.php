<?php

namespace SenderSolutions\Email\EmailAddress;

class EmailAddress implements EmailAddressInterface
{
    public function __construct(protected string $email, protected string $name)
    {
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
