<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Services\PengembalianService;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    protected $service;

    public function __construct(PengembalianService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = Peminjaman::where('status', 'active')->get();

        return view('admin.pengembalian.index', compact('data'));
    }

    public function proses($id)
    {
        $this->service->proses($id);

        return back()->with('success', 'Pengembalian berhasil');
    }
}
