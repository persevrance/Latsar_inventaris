<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\Controller;
use App\Models\HistoryBarang;

class HistoryController extends Controller
{
    public function index()
    {
        return view('admin.history.index', [
            'data' => HistoryBarang::latest()->get()
        ]);
    }
}
