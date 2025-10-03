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
            <h1 class="mb-4">Katalog</h1>
            <div class="row">
                @foreach ($produk as $item)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/produk/' . $item->foto_produk) }}" class="card-img-top"
                                alt="{{ $item->nama_produk }}" />
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $item->nama_produk }}
                                </h5>
                                <p class="card-text">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi_produk), 80) }}
                                </p>
                                <p class="card-text">
                                    Harga : Rp
                                    {{ number_format($item->harga_produk, 0, ',', '.') }}
                                </p>
                                <p class="card-text">
                                    Stok : {{ $item->stock_produk }}
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('produk.show', $item->id) }}" class="btn btn-primary" target="_blank">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
