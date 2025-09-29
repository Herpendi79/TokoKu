<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; min-height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">MyApp</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ url('/user/dashboard') }}"
                class="nav-link {{ request()->is('user/dashboard') ? 'active' : 'link-dark' }}">
                Dashboard User
            </a>
        </li>
        <li>
            <a href="#"
                class="nav-link">
                Produk
            </a>
        </li>
        <li>
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
