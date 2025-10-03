<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h1 class="mb-4">Detail Produk</h1>
                        <div class="text-center mb-4">
                            <img src="{{ asset('storage/produk/' . $produk->foto_produk) }}" alt="{{ $produk->nama_produk }}" class="img-fluid" style="max-width: 300px;">
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
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali ke Daftar Produk</a>    
                        <button che
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
   </body>

</html>
