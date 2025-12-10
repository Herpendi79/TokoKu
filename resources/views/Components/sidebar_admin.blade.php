<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; min-height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">MyApp</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ url('/admin/dashboard') }}"
                class="nav-link {{ request()->is('admin/dashboard') ? 'active' : 'link-dark' }}">
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('produk.index') }}"
                class="nav-link {{ request()->is('admin/produk*') ? 'active' : 'link-dark' }}">
                Produk
            </a>
        </li>
        <li>
            <a href="{{ route('qrcode.index') }}"
                class="nav-link {{ request()->is('admin/qrcode*') ? 'active' : 'link-dark' }}">
                QR Code
            </a>
        </li>
        <li>
            <a href="{{ route('locations.index') }}"
                class="nav-link {{ request()->is('admin/locations*') ? 'active' : 'link-dark' }}">
                Location
            </a>
        </li>
        <li>
            <a wire:navigate href="{{ route('pelanggans.index') }}"
                class="nav-link {{ request()->routeIs('pelanggans.index') ? 'active' : 'link-dark' }}">
                Pelanggan
            </a>
        </li>
        <a href="{{ route('logout') }}" class="nav-link link-dark"
            onclick="event.preventDefault(); 
                if(confirm('Apakah Anda yakin ingin logout?')) {
                    document.getElementById('logout-form').submit();
                }">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </li>

    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
            id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>{{ Auth::user()->name ?? 'Guest' }}</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
        </ul>
    </div>
</div>
