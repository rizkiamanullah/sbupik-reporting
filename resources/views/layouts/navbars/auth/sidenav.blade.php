<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}"
            target="_blank">
            <img src="{{url('/img/character.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">SUPERMAN Sucofindo</span>
        </a>
    </div>
    <hr class="horizontal dark my-0">
    <div class="collapse navbar-collapse w-auto" style="height:80vh;" id="sidenav-collapse-main">
    <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <h5 class="p-3 py-2 text-white m-2" style="background-color:forestgreen; border-radius:90px;">{{strtoupper(Auth::user()->firstname[0])}}</h5>
                    <span><b>{{Auth::user()->firstname}}</b></span>
                </a>
            </li>
            <hr class="horizontal dark my-0">
            <li class="nav-item px-2">
                <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link text-danger font-weight-bold">
                        <i class="ni ni-button-power"></i>
                        <span class="text-danger">&nbsp;Log Out</span>
                    </a>
                </form>
            </li>
            <hr class="horizontal dark mt-0">

        @if (Auth::user()->user_role_id == 99)
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Laman Utama</span>
                </a>
            </li>
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{ str_contains(request()->url(), 'project-management') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'project-management']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-briefcase-24 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Atur Proyek</span>
                </a>
            </li>
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'user-management']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Atur Pengguna</span>
                </a>
            </li>
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{ str_contains(request()->url(), 'customer-management') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'customer-management']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Atur Customer</span>
                </a>
            </li>
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{  str_contains(request()->url(), 'role-management') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'role-management']) }}">
                    <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-single-02 text-secondary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Atur Role</span>
            </a>
        </li>
        <li class="nav-item btn-outline-secondary">
            <a class="nav-link {{  str_contains(request()->url(), 'news-management') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'news-management']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-align-left-2 text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Atur Pengumuman/ Berita</span>
                </a>
            </li>
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{  str_contains(request()->url(), 'my-message') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'my-message']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-chat-round text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pesan</span>
                </a>
            </li>
            {{-- <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{  str_contains(request()->url(), 'message-log') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'message-log']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-chat-round text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Log Pesan</span>
                </a>
            </li> --}}
        @endif

        {{-- officer --}}
        @if (Auth::user()->user_role_id == 1)
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            {{-- <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{ str_contains(request()->url(), 'project') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'project-management']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-folder-17 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Proyek</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{  str_contains(request()->url(), 'kanban') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'kanban']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-button-pause text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Kanban</span>
                </a>
            </li> --}}
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{  str_contains(request()->url(), 'reporting') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'reporting']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-button-pause text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pelaporan Harian</span>
                </a>
            </li>
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{  str_contains(request()->url(), 'monthly') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'monthly']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-button-pause text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pelaporan Mingguan</span>
                </a>
            </li>
            {{-- <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{  str_contains(request()->url(), 'news-management') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'news-management']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pengumuman/ Berita</span>
                </a>
            </li> --}}
            {{-- <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{  str_contains(request()->url(), 'my-message') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'my-message']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-chat-round text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pesan</span>
                </a>
            </li> --}}
        @endif

        {{-- manager --}}
        @if (Auth::user()->user_role_id == 2)
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Laman Utama</span>
                </a>
            </li>
            {{-- <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{  str_contains(request()->url(), 'reporting') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'reporting']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-button-pause text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pelaporan</span>
                </a>
            </li> --}}
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{ str_contains(request()->url(), 'list-officer') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'list-officer']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-folder-17 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pelaporan Pegawai</span>
                </a>
            </li>
            {{-- <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{ str_contains(request()->url(), 'monev-management') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'monev-management']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-money-coins text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Keuangan Proyek</span>
                </a>
            </li>
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{ str_contains(request()->url(), 'project-management') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'project-management']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-briefcase-24 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Atur Proyek</span>
                </a>
            </li>
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'user-management']) }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Anggota Proyek</span>
                </a>
            </li>
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{  str_contains(request()->url(), 'kanban') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'kanban']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-button-pause text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Kanban</span>
                </a>
            </li>
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{  str_contains(request()->url(), 'news-management') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'news-management']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-copy-04 text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pengumuman/ Berita</span>
                </a>
            </li>
            <li class="nav-item btn-outline-secondary">
                <a class="nav-link {{  str_contains(request()->url(), 'my-message') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'my-message']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-chat-round text-secondary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pesan</span>
                </a>
            </li> --}}
        @endif
        </ul>
    </div>
    <div class="sidenav-footer">
        <ul class="navbar-nav">
            {{-- <li class="nav-item">
                <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link text-danger font-weight-bold">
                        <i class="ni ni-button-power"></i>
                        <span class="text-danger">Keluar</span>
                    </a>
                </form>
            </li> --}}
        </ul>
    </div>
</aside>