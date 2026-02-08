<?php

namespace SenderSolutions;

class ListResult
{
    public function __construct(
        protected int $TotalCount,
        protected int $Offset,
        protected int $Limit,
        protected array $List,
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
            'List' => $this->List,
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

    public function getList(): array
    {
        return $this->List;
    }
}
