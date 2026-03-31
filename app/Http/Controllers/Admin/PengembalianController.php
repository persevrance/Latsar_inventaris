<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Base\Controller;
use App\Models\Peminjaman;
use App\DTO\Pengembalian\PengembalianDTO;
use App\Actions\Pengembalian\ProcessPengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function store(Request $request, Peminjaman $peminjaman, ProcessPengembalian $process)
    {
        $dto = PengembalianDTO::fromArray($request->all());

        $process->execute(
            $peminjaman,
            $dto->toKeyValue()
        );

        return back()->with('success', 'Pengembalian diproses');
    }
}
