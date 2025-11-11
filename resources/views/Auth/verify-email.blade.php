@extends('Layouts.app')

@section('content')
<div class="container">
    <h2>Verifikasi Email Anda</h2>
    <p>
        Sebelum melanjutkan, silakan cek email Anda untuk tautan verifikasi.
        Jika belum menerima email, klik tombol di bawah untuk kirim ulang.
    </p>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Kirim Ulang Email Verifikasi</button>
    </form>
</div>
@endsection