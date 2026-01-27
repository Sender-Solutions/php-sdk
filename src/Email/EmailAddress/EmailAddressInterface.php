<?php

namespace SenderSolutions\Email\EmailAddress;

interface EmailAddressInterface
{
    public function __construct(string $email, string $name);

    public function setEmail(string $email): static;
    public function setName(string $name): static;

    public function getEmail(): string;
    public function getName(): string;
}
