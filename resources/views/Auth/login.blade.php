@extends('Layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cek_login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <br>
                            <div class="form-group mb-0 row">
                                <div class="col-12">
                                    <div class="d-grid">
                                        <a href="{{ route('auth.google') }}"
                                            class="btn btn-light fw-semibold d-flex align-items-center justify-content-center border">
                                            <img src="{{ url('/') }}/assets/g-logo-login.png" alt="Google Logo"
                                                style="width: 20px; height: 20px; margin-right: 10px;">
                                            Masuk dengan Google
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <small>Belum punya akun? <a href="{{ route('registerForm') }}">Daftar</a></small>
                    </div>
                    <div class="card-footer text-center">
                        <small>Lupa Password? <a href="{{ route('lupaPassword') }}">Klik Disini</a></small>
                    </div>

                    <div class="mb-3 text-center">
                        <a href="{{ route('katalog') }}" class="btn btn-link">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
@endsection
