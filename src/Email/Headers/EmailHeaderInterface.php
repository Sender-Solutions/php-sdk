<?php

namespace SenderSolutions\Email\Headers;

interface EmailHeaderInterface
{
    public function __construct(string $name, string $value);

    public function setName(string $name): static;
    public function setValue(string $value): static;
    public function getName(): string;
    public function getValue(): string;
}
