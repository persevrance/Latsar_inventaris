<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangItemRequest;
use App\Services\BarangItemService;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Lokasi;

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
        return view('admin.barang-item.create', [
            'barang' => Barang::with('lokasi')->get(),
        ]);
    }

    public function store(BarangItemRequest $request)
    {
        try {
            $data = $request->validated();

            $this->service->store($data);

            return redirect()
                ->route('barang.show', $data['barang_id'])
                ->with('success', 'Barang item berhasil ditambahkan');
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
}
