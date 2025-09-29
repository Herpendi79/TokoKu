<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">

                        <h1 class="mb-4">Tambah Produk</h1>
                        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="text"
                                    class="form-control @error('nama_produk') is-invalid @enderror id="nama_produk"
                                    name="nama_produk" value="{{ old('nama_produk') }}"
                                    placeholder="Masukkan Nama Produk">
                                @error('nama_produk')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_produk">Deskripsi Produk</label>
                                <textarea class="form-control @error('deskripsi_produk') is-invalid @enderror" id="deskripsi_produk"
                                    name="deskripsi_produk" placeholder="Masukkan Deskripsi Produk">{{ old('deskripsi_produk') }}</textarea>
                                @error('deskripsi_produk')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="harga_produk">Harga Produk</label>
                                <input type="text" class="form-control @error('harga_produk') is-invalid @enderror"
                                    id="harga_produk_display" placeholder="Masukkan Harga Produk"
                                    value="{{ old('harga_produk') ? 'Rp ' . number_format(old('harga_produk'), 0, ',', '.') : '' }}">

                                <!-- Hidden field untuk menyimpan angka murni -->
                                <input type="hidden" id="harga_produk" name="harga_produk"
                                    value="{{ old('harga_produk') }}">

                                @error('harga_produk')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <script>
                                const displayInput = document.getElementById('harga_produk_display');
                                const hiddenInput = document.getElementById('harga_produk');

                                displayInput.addEventListener('input', function(e) {
                                    // Hapus semua karakter non-digit
                                    let value = this.value.replace(/[^0-9]/g, '');
                                    if (value) {
                                        // Format jadi Rupiah
                                        this.value = new Intl.NumberFormat('id-ID', {
                                            style: 'currency',
                                            currency: 'IDR'
                                        }).format(value).replace(",00", "");
                                    } else {
                                        this.value = "";
                                    }
                                    // Simpan angka asli ke hidden input
                                    hiddenInput.value = value;
                                });
                            </script>

                            <div class="form-group">
                                <label for="stock_produk">Stok Produk</label>
                                <input type="number" class="form-control @error('stock_produk') is-invalid @enderror"
                                    id="stock_produk" name="stock_produk" value="{{ old('stock_produk') }}"
                                    placeholder="Masukkan Stok Produk">
                                @error('stock_produk')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="foto_produk">Foto Produk</label>
                                <input type="file" class="form-control @error('foto_produk') is-invalid @enderror"
                                    id="foto_produk" name="foto_produk">
                                @error('foto_produk')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>ß
                            <button type="submit" class="btn btn-primary">Simpan Produk</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('deskripsi_produk');
    </script>
</body>

</html>
