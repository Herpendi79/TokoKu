<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProdukExport;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = ProdukModel::latest()->paginate(10);
        return view('Admin_page.produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'harga_produk' => 'required|numeric',
            'stock_produk' => 'required|integer',
            'foto_produk' =>
                'required|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $image = $request->file('foto_produk');
        $image->storeAs('produk', $image->hashName());

        ProdukModel::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga_produk' => $request->harga_produk,
            'stock_produk' => $request->stock_produk,
            'foto_produk' => $image->hashName(),
        ]);
        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $produk = ProdukModel::findOrFail($id);
        return view('produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = ProdukModel::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'harga_produk' => 'required|numeric',
            'stock_produk' => 'required|integer',
            'foto_produk' =>
                'sometimes|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $produk = ProdukModel::findOrFail($id);

        if ($request->hasFile('foto_produk')) {
            // Hapus foto lama jika ada
            if (
                $produk->foto_produk &&
                Storage::exists('produk/' . $produk->foto_produk)
            ) {
                Storage::delete('produk/' . $produk->foto_produk);
            }

            $image = $request->file('foto_produk');
            $image->storeAs('produk', $image->hashName());
            $produk->foto_produk = $image->hashName();
        }

        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->harga_produk = $request->harga_produk;
        $produk->stock_produk = $request->stock_produk;
        $produk->save();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse
    {
        $produk = ProdukModel::findOrFail($id);

        // Hapus foto produk jika ada
        if (
            $produk->foto_produk &&
            Storage::exists('produk/' . $produk->foto_produk)
        ) {
            Storage::delete('produk/' . $produk->foto_produk);
        }

        $produk->delete();
        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function katalog()
    {
        $produk = ProdukModel::all();
        return view('welcome', compact('produk'));
    }

    public function export()
    {
        return Excel::download(new ProdukExport(), 'produk.xlsx');
    }
}
