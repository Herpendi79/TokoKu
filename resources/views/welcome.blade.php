@extends('Layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-3">Fake Shop</h2>
        <p>
            Belanja online murah, aman dan nyaman dari berbagai toko online di
            Indonesia.
        </p>
        <div class="row">
            @foreach ($produk as $item)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img
                            src="{{ asset('storage/produk/' . $item->foto_produk) }}"
                            class="card-img-top"
                            alt="{{ $item->nama_produk }}"
                        />
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
                            <a
                                href="{{ route('produk.show', $item->id) }}"
                                class="btn btn-primary"
                                target="_blank"
                            >
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
