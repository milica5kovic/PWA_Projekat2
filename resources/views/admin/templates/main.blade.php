<div class="d-flex gap-2 justify-content-center">
<nav id="sidebar" class="bg-light border-left position-fixed h-100" style="right: 0; width: 250px;">
        <div class="sidebar-header p-3 mb-3 border-bottom">
            @auth
                <h5>Welcome back, {{ Auth::user()->name }}!</h5>
            @else
                <h5>Menu</h5>
            @endauth
        </div>

        <ul class="nav flex-column flex-grow-3 p-3 ml-2">
            <p class="text-muted">Admin Navigation</p>

            <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.pocetna') }}">Pocetna</a>
            </li>
            <li class="nav-item {{ Request::is('admin/proizvodi*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.proizvodi') }}">Proizvodi</a>
            </li>
            <li class="nav-item {{ Request::is('admin/kategorije*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.kategorije') }}">Kategorije</a>
            </li>
            @if(Auth::user()->role === "admin")
                <li class="nav-item {{ Request::is('admin/porudzbine*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.porudzbine') }}">Porudzbine</a>
                </li>
            @endif
            <li class="nav-item">
                <hr>
                <form method="POST" action="{{ route('odjava') }}">
                    @csrf
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                this.closest('form').submit();">
                        Odjavite se
                    </a>
                </form>
            </li>
        </ul>
    </nav>
    <div class="flex-grow-1">
        @yield('content')
    </div>
</div>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
<style>
    .nav-item.active .nav-link {
        color: #fff;
        background-color: #007bff;
    }

    .nav-link:hover {
        background-color: #e9ecef;
    }
</style>
