<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        @include('Components.sidebar_admin')

        {{-- Konten utama --}}
        <div class="container-fluid p-4">
            <h1 class="mb-4">Daftar Produk</h1>
            <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
            <a href="{{ route('produk.export') }}" class="btn btn-success mb-3">Export to Excel</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Foto Produk</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi Produk</th>
                        <th>Harga Produk</th>
                        <th>Stok Produk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $item)
                        <tr>
                            <td><img src="{{ asset('storage/produk/' . $item->foto_produk) }}"
                                    alt="{{ $item->nama_produk }}" width="100"></td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>{!! Str::words($item->deskripsi_produk, 20, '...') !!}</td>
                            <td>{{ number_format($item->harga_produk, 0, ',', '.') }}</td>
                            <td>{{ $item->stock_produk }}</td>
                            <td>
                                <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');"
                                    action="{{ route('produk.destroy', $item->id) }}" method="POST">
                                    <a href="{{ route('produk.show', $item->id) }}" class="btn btn-success btn-sm"
                                        target="_blank">Detil</a>
                                    <a href="{{ route('produk.edit', $item->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data Produk belum Tersedia.
                        </div>
                    @endforelse
                </tbody>
            </table>
            {{ $produk->links() }}
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif
        </script>

</body>

</html>
