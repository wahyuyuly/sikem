<nav class="navbar navbar-expand-lg main-navbar">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
                collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
                </a>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        {{-- <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown"
                class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
            <span class="badge headerBadge1">
            6 </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                <div class="dropdown-header">
                    Messages
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-message">
                    <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar
                        text-white"> <img alt="image" src="{{ asset('assets/backend/img/users/user-1.png') }}" class="rounded-circle">
                    </span> <span class="dropdown-item-desc"> <span class="message-user">John
                    Deo</span>
                    <span class="time messege-text">Please check your mail !!</span>
                    <span class="time">2 Min Ago</span>
                    </span>
                    </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{ asset('assets/backend/img/users/user-2.png') }}" class="rounded-circle">
                    </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                    Smith</span> <span class="time messege-text">Request for leave
                    application</span>
                    <span class="time">5 Min Ago</span>
                    </span>
                    </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{ asset('assets/backend/img/users/user-5.png') }}" class="rounded-circle">
                    </span> <span class="dropdown-item-desc"> <span class="message-user">Jacob
                    Ryan</span> <span class="time messege-text">Your payment invoice is
                    generated.</span> <span class="time">12 Min Ago</span>
                    </span>
                    </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{ asset('assets/backend/img/users/user-4.png') }}" class="rounded-circle">
                    </span> <span class="dropdown-item-desc"> <span class="message-user">Lina
                    Smith</span> <span class="time messege-text">hii John, I have upload
                    doc
                    related to task.</span> <span class="time">30
                    Min Ago</span>
                    </span>
                    </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{ asset('assets/backend/img/users/user-3.png') }}" class="rounded-circle">
                    </span> <span class="dropdown-item-desc"> <span class="message-user">Jalpa
                    Joshi</span> <span class="time messege-text">Please do as specify.
                    Let me
                    know if you have any query.</span> <span class="time">1
                    Days Ago</span>
                    </span>
                    </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{ asset('assets/backend/img/users/user-2.png') }}" class="rounded-circle">
                    </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                    Smith</span> <span class="time messege-text">Client Requirements</span>
                    <span class="time">2 Days Ago</span>
                    </span>
                    </a>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg"><i data-feather="bell"></i>
            <span class="badge headerBadge2">
            3 </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                <div class="dropdown-header">
                    Notifications
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    <a href="#" class="dropdown-item dropdown-item-unread"> <span
                        class="dropdown-item-icon bg-primary text-white"> <i class="fas
                        fa-code"></i>
                    </span> <span class="dropdown-item-desc"> Template update is
                    available now! <span class="time">2 Min
                    Ago</span>
                    </span>
                    </a> 
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li> --}}
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if (!empty(Auth::user()->photo))
                    <img alt="image" src="{{ asset('storage/photos/'.Auth::user()->photo) }}" class="user-img-radious-style" style="width:40px; height:40px;">
                @else
                    <img alt="image" src="{{ asset('assets/img/foto-m.png') }}" class="user-img-radious-style" style="width:40px; height:40px;">
                @endif 
                <span class="d-sm-none d-lg-inline-block"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Halo, {{ Auth::user()->name }}!</div>
               {{-- <a href="profile.html" class="dropdown-item has-icon"><i class="far fa-user"></i>
                    Profil
                </a>
                <a href="timeline.html" class="dropdown-item has-icon"><i class="fas fa-bolt"></i>
                    Activities
                </a> --}}
                <a href="{{ url('/') }}" target="_blank" class="dropdown-item has-icon"><i class="fas fa-th-large"></i>
                    Halaman Web
                </a>
                <a href="{{ route('pengguna.edit', Auth::user()->id) }}" class="dropdown-item has-icon"><i class="fas fa-cog"></i>
                    Pengaturan
                </a>

                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    Keluar
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>