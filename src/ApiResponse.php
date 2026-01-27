<?php

namespace SenderSolutions;

use Psr\Http\Message\ResponseInterface;

class ApiResponse
{
    public function __construct(
        private string $rawBody,
        private int    $statusCode,
        private array  $headers,
        private array  $json = []
    )
    {
    }

    public static function fromGuzzleResponse(ResponseInterface $response): self
    {
        $rawBody = $response->getBody()->getContents();

        $json = [];
        if ($rawBody !== '') {
            $decoded = json_decode($rawBody, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $json = $decoded;
            }
        }

        return new self(
            rawBody: $rawBody,
            statusCode: $response->getStatusCode(),
            headers: $response->getHeaders(),
            json: $json
        );
    }

    public function getRawBody(): string
    {
        return $this->rawBody;
    }

    public function getJson(): array
    {
        return $this->json;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function isSuccess(): bool
    {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }
}
