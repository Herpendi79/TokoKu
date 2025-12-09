<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lokasi Maps</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        #map-create {
            height: 300px;
        }

        #btnMyLocation {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="d-flex">

        {{-- Sidebar --}}
        @include('Components.sidebar_admin')

        {{-- Konten Utama --}}
        <div class="container-fluid p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">Daftar Lokasi Maps</h1>
            </div>

            <!-- Tombol Tambah -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                data-bs-target="#addLocationModal">
                Tambah Lokasi
            </button>

            <!-- Modal Tambah -->
            <div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('locations.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Lokasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <div class="mb-3">
                                    <label class="form-label">Nama Lokasi</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" id="latitude" name="latitude" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" id="longitude" name="longitude" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-success mb-3" id="btnMyLocation">
                                    Deteksi Lokasi Saya
                                </button>

                                <div id="map-create"></div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabel -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($locations as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->latitude }}</td>
                            <td>{{ $item->longitude }}</td>
                            <td>
                                <a href="{{ route('locations.tracking', $item->id) }}" target="_blank"
                                    class="btn btn-success btn-sm">Tracking</a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-danger">Belum ada data lokasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $locations->links() }}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Notifikasi -->
    <script>
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "Sukses",
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>

    <!-- Inisialisasi Map -->
    <script>
        let mapCreate = L.map('map-create').setView([-6.2, 106.8], 10);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapCreate);

        let markerCreate = null;

        // Klik pada map → update posisi marker TANPA kedip
        mapCreate.on('click', function(e) {
            let lat = e.latlng.lat;
            let lng = e.latlng.lng;

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Smooth: marker tidak dihapus, hanya dipindahkan
            if (!markerCreate) {
                markerCreate = L.marker([lat, lng]).addTo(mapCreate);
            } else {
                markerCreate.setLatLng([lat, lng]);
            }
        });

        // FIX MAP DALAM MODAL → tanpa kedip
        const modalAdd = document.getElementById('addLocationModal');
        modalAdd.addEventListener('shown.bs.modal', function() {
            const modalDialog = modalAdd.querySelector('.modal-dialog');

            // Pastikan map resize setelah transition selesai
            modalDialog.addEventListener('transitionend', () => {
                mapCreate.invalidateSize();
            }, {
                once: true
            });

            // Backup kecil
            setTimeout(() => {
                mapCreate.invalidateSize();
            }, 80);
        });

        // Deteksi Lokasi Saya → tanpa kedip
        document.getElementById('btnMyLocation').addEventListener('click', function() {
            if (!navigator.geolocation) {
                alert("Browser Anda tidak mendukung Geolocation.");
                return;
            }

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    // Isi input
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;

                    // Geser map smooth
                    mapCreate.flyTo([lat, lng], 16, {
                        duration: 0.5
                    });

                    // Marker smooth update
                    if (!markerCreate) {
                        markerCreate = L.marker([lat, lng]).addTo(mapCreate);
                    } else {
                        markerCreate.setLatLng([lat, lng]);
                    }
                },
                function(error) {
                    alert("Gagal mendapatkan lokasi. Pastikan GPS aktif dan izinkan akses lokasi.");
                }
            );
        });
    </script>

</body>

</html>