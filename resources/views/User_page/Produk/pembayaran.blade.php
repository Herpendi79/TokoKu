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
                            <h1 class="mb-4">Pembayaran</h1>
                            <div class="text-center mb-4">
                                <h3>Silakan lakukan pembayaran dengan mengklik tombol di bawah ini:</h3>
                                <h4 class="mt-3">Total yang harus dibayar: Rp {{ number_format($price, 0, ',', '.') }}
                                </h4>
                                <h5 class="mt-2">Status: {{ $status }}</h5>
                            </div>
                            <button id="pay-button" class="btn btn-primary mt-3">Bayar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.clientKey') }}"></script>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran Anda telah berhasil.");
                    location.reload(); // refresh halaman setelah klik OK
                },
                onPending: function(result) {
                    alert("Pembayaran Anda sedang diproses.");
                },
                onError: function(result) {
                    alert("Pembayaran gagal. Silakan coba lagi.");
                }
            });
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
