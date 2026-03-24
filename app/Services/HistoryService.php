<?php

namespace App\Services;

use App\Repositories\HistoryRepository;

class HistoryService
{
    protected $repo;

    public function __construct(HistoryRepository $repo)
    {
        $this->repo = $repo;
    }

    public function latest($limit = 10)
    {
        return $this->repo->latest($limit);
    }

    public function getByItem($barang_item_id)
    {
        return $this->repo->getByItem($barang_item_id);
    }

    public function getByUser($user_id)
    {
        return $this->repo->getByUser($user_id);
    }
}
