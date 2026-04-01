<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Base\Controller;
use App\DTO\Peminjaman\PeminjamanDTO;
use App\Actions\Peminjaman\CreatePeminjaman;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pages.pegawai.peminjaman.index', compact('data'));
    }
    public function store(Request $request, CreatePeminjaman $action)
    {
        $dto = PeminjamanDTO::fromArray([
            'user_id' => auth()->id(),
            'items'   => $request->items
        ]);

        $action->execute([
            'user_id' => $dto->user_id,
            'items'   => $dto->getItemIds(),
        ]);

        return back()->with('success', 'Pengajuan berhasil');
    }
}
