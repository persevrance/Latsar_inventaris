<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangItemRequest;
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

    public function store(BarangItemRequest $request)
    {
        try {
            //data sudah tervalidasi
            $data = $request->validated();

            //panggil service (SP)
            $this->service->store($data);

            return redirect()
                ->back()
                ->with('success', 'Barang item berhasil ditambahkan');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}
