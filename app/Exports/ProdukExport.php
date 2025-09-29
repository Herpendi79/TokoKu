<?php

namespace App\Exports;

use App\Models\ProdukModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukExport implements FromCollection, WithHeadings  
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProdukModel::select('id', 'nama_produk', 'deskripsi_produk', 'harga_produk', 'stock_produk')->get();
    }

    public function headings(): array
    {
        return ["ID", "Nama Produk", "Deskripsi Produk", "Harga Produk", "Stok Produk"];
    }
}
