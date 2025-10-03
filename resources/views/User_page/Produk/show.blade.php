<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        @include('Components.sidebar_user')

        {{-- Konten utama --}}
        <div class="container-fluid p-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <h1 class="mb-4">Detail Produk</h1>
                            <div class="text-center mb-4">
                                <img src="{{ asset('storage/produk/' . $produk->foto_produk) }}"
                                    alt="{{ $produk->nama_produk }}" class="img-fluid" style="max-width: 300px;">
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Produk</th>
                                    <td>{{ $produk->nama_produk }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi Produk</th>
                                    <td>{!! $produk->deskripsi_produk !!}</td>
                                </tr>
                                <tr>
                                    <th>Harga Produk</th>
                                    <td>{{ number_format($produk->harga_produk, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Stok Produk</th>
                                    <td>{{ $produk->stock_produk }}</td>
                                </tr>
                            </table>
                            <form action="{{ route('transaksi.store_user') }}" method="POST">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                <div class="mb-3">
                                </div>
                                <button type="submit" class="btn btn-success">Beli</button>
                            </form>
                            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali ke Daftar Produk</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
