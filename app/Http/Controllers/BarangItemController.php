<?php

namespace App\Http\Controllers;

use App\Services\BarangItemService;
use Illuminate\Http\Request;

class BarangItemController extends Controller
{
    protected $service;

    public function __construct(BarangItemService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('admin.barang-item.index');
    }

    public function create()
    {
        return view('admin.barang-item.create');
    }

    public function store(Request $request)
    {
        try {
            $this->service->store($request->all());

            return back()->with('success', 'Item berhasil ditambahkan');
        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }
}
