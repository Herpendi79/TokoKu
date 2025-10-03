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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Status</th>
                                        <th>Tanggal Transaksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transaksi as $item)
                                        <tr>
                                            <td>{{ $item->order_id }}</td>
                                            <td>{{ $item->produk->nama_produk }}</td>
                                            <td>{{ number_format($item->produk->harga_produk, 0, ',', '.') }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->created_at }}</td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Produk belum Tersedia.
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $transaksi->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
