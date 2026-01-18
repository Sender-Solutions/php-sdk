<?php

namespace SenderSolutions\Subscriber;

class SubscribersListResult
{
    public function __construct(
        private int $TotalCount,
        private int $Offset,
        private int $Limit,
        private array $Subscribers,
    )
    {
    }

    public function isLastPage(): bool
    {
        return $this->Offset + $this->Limit >= $this->TotalCount;
    }

    public function toArray(): array
    {
        return [
            'TotalCount' => $this->TotalCount,
            'Offset' => $this->Offset,
            'Limit' => $this->Limit,
            'Subscribers' => $this->Subscribers,
        ];
    }

    public function getTotalCount(): int
    {
        return $this->TotalCount;
    }

    public function getOffset(): int
    {
        return $this->Offset;
    }

    public function getLimit(): int
    {
        return $this->Limit;
    }

    public function getSubscribers(): array
    {
        return $this->Subscribers;
    }
}
