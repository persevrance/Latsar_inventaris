<?php

namespace App\Repositories;

class BaseRepository
{
    protected function query($model)
    {
        return $model::query();
    }
}
