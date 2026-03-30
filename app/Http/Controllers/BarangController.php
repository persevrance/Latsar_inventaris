<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\BarangItem;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Services\BarangService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    protected $service;

    public function __construct(BarangService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = Barang::with(['lokasi'])
            ->withCount('items')
            ->get();

        return view('admin.barang.index', compact('data'));
    }

    public function create()
    {
        return view('admin.barang.create', [
            'kategori' => Kategori::all(),
            'lokasi' => Lokasi::all()
        ]);
    }

    public function store(BarangRequest $request)
    {
        try {
            $data = $request->validated();

            $this->service->store($data);

            return redirect()
                ->route('barang.index')
                ->with('success', 'Barang berhasil ditambahkan');
        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        return view('admin.barang.edit', [
            'data' => Barang::findOrFail($id),
            'kategori' => Kategori::all(),
            'lokasi' => Lokasi::all()
        ]);
    }

    public function update(BarangRequest $request, $id)
    {
        try {
            $data = $request->validated();

            $this->service->update($id, $data);

            return redirect()
                ->route('barang.index')
                ->with('success', 'Barang berhasil diperbarui');
        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $barang = Barang::with(['items'])
                ->withCount('items')
                ->findOrFail($id);

            DB::table('arsip_barang')->insert([
                'barang_id' => $barang->id,
                'nama_barang' => $barang->nama_barang,
                'kode_barang' => $barang->kode_barang,
                'lokasi_id' => $barang->lokasi_id,
                'items_count' => $barang->items_count,
                'data_json' => json_encode([
                    'barang' => $barang->only([
                        'id',
                        'nama_barang',
                        'kode_barang',
                        'lokasi_id'
                    ]),
                    'items' => $barang->items->map(function ($item) {
                        return $item->only([
                            'id',
                            'kode_item',
                            'status',
                            'rak'
                        ]);
                    })
                ]),
                'archived_by' => Auth::id(),
            ]);

            $barang->delete();

            DB::commit();

            return back()->with('success', 'Barang berhasil diarsipkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function show(Barang $barang)
    {
        $barang->load([
            'lokasi',
            'items.lokasi',
            'items.peminjamanAktif.user',
        ]);

        return view('admin.barang.show', compact('barang'));
    }

    public function arsip()
    {
        $data = \Illuminate\Support\Facades\DB::table('arsip_barang')
            ->latest()
            ->get();

        return view('admin.arsip.index', compact('data'));
    }

    public function showArsip($id)
    {
        $arsip = DB::table('arsip_barang')->find($id);

        if (!$arsip) {
            abort(404);
        }

        $data = json_decode($arsip->data_json, true);

        return view('admin.arsip.show', [
            'arsip' => $arsip,
            'barang' => $data['barang'] ?? [],
            'items' => $data['items'] ?? []
        ]);
    }

    public function indexPegawai(Request $request)
    {
        $query = BarangItem::with([
            'barang.kategori',
            'barang.lokasi'
        ]);

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('barang', function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }

        $data = $query->latest()->get();

        return view('pegawai.barang.index', compact('data'));
    }
}
