<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class BaseService
{
    protected function callSP($query, $params = [])
    {
        try {
            return DB::statement($query, $params);
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
