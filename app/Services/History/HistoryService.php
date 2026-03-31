<?php

namespace App\Services\History;

use App\Repositories\HistoryRepository;

class HistoryService
{
    public function __construct(
        protected HistoryRepository $repo
    ) {}

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function filter(array $filters)
    {
        return $this->repo->filter($filters);
    }

    public function log(array $data)
    {
        return $this->repo->create($data);
    }
}
