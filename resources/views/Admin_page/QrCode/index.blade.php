<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        @include('Components.sidebar_admin')

        {{-- Konten utama --}}
        <div class="container-fluid p-4">
            <h1 class="mb-4">Daftar QR Code</h1>
            <!-- Tombol untuk memicu modal -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addQrCodeModal">
                Tambah QR Code
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addQrCodeModal" tabindex="-1" aria-labelledby="addQrCodeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('qrcode.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addQrCodeModalLabel">Tambah QR Code</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama_qrcode" class="form-label">Kode QR</label>
                                    <input type="text" class="form-control" id="nama_qrcode" name="nama_qrcode"
                                        required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Link</th>
                        <th>Image</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($qrcode as $item)
                        <tr>
                            <td>
                                <a href="{{ url('storage/qrcode/' . $item->nama_qrcode) }}" target="_blank">
                                    {{ $item->nama_qrcode }}
                                </a>
                            </td>
                            <td>
                                <img src="{{ asset('storage/qrcode/' . $item->nama_qrcode) }}"
                                    alt="{{ $item->nama_qrcode }}" width="100">
                            </td>
                            <td>
                                <a href="{{ asset('storage/qrcode/' . $item->nama_qrcode) }}"
                                    download="{{ $item->nama_qrcode }}" class="btn btn-warning btn-sm">
                                    Download
                                </a>
                            </td>

                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data QR Code Belum Tersedia.
                        </div>
                    @endforelse
                </tbody>
            </table>
            {{ $qrcode->links() }}
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