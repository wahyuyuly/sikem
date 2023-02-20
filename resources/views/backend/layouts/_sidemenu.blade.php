<div class="main-sidebar sidebar-style-2" style="padding-bottom: 30px;">
    <aside id="sidebar-wrapper" style="padding-bottom: 30px;">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}"> <img style="height: 50px;" alt="logo" src="{{ asset('assets/logo.png') }}" class="header-logo" />
            </a>
        </div>
        <div class="sidebar-user">
            <div class="sidebar-user-picture">
                @if (!empty(Auth::user()->photo))
                    <img alt="image" src="{{ asset('storage/photos/'.Auth::user()->photo) }}" style="max-width:70px; max-height:70px;">
                @else
                    <img alt="image" src="{{ asset('assets/img/foto-m.png') }}" style="max-width:70px; max-height:70px;">
                @endif
            </div>
            <div class="sidebar-user-details">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ Auth::user()->roles()->first()->display_name }}</div>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Beranda</li>
            <li>
                <a href="{{ route('home') }}"><i data-feather="monitor"></i><span>Beranda</span></a>
            </li>
            @role(['super-admin', 'admin-jurusan'])
            <li>
                <a href="{{ route('request-user.index') }}"><i data-feather="radio"></i><span>Request Pengguna Baru</span></a>
            </li>
            @endrole

            <li class="menu-header">Menu</li>
            @role(['super-admin', 'admin-jurusan', 'admin-berita', 'bem'])
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i data-feather="book-open"></i><span>Artikel</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('artikel.index') }}">Semua Artikel</a></li>
                    <li><a class="nav-link" href="{{ route('artikel.trash') }}">Kotak Sampah</a></li>
                    <li><a class="nav-link" href="{{ route('kategori.index') }}">Kategori</a></li>
                </ul>
            </li>
            @endrole
            @role(['super-admin', 'admin-jurusan'])
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i data-feather="slack"></i><span>Pengumuman</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('pengumuman.index') }}">Semua Pengumuman</a></li>
                        <li><a class="nav-link" href="{{ route('pengumuman.trash') }}">Kotak Sampah</a></li>
                        <li><a class="nav-link" href="{{ route('kategori-pengumuman.index') }}">Kategori</a></li>
                    </ul>
                </li>
            @endrole
            
            @role(['super-admin', 'admin-jurusan', 'admin-berita'])
            <li class="menu-header">Peserta Didik</li>
            <li class="dropdown {{ isset($root) && $root == 'mahasiswa' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i data-feather="gitlab"></i><span>Mahasiswa</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ isset($sub) && $sub == 'index' ? 'active' : '' }}"><a class="nav-link" href="{{ route('mahasiswa.index') }}">Daftar Mahasiswa</a></li>
                    <li class="{{ isset($sub) && $sub == 'add' ? 'active' : '' }}"><a class="nav-link" href="{{ route('mahasiswa.create') }}">Tambah Mahasiswa</a></li>
                    <li><a class="nav-link" href="{{ route('mahasiswa.import') }}">Import Mahasiswa</a></li>
                </ul>
            </li>
            <li class="dropdown {{ isset($root) && $root == 'alumni' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i data-feather="codepen"></i><span>Alumni</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ isset($sub) && $sub == 'daftar-alumni' ? 'active' : '' }}"><a class="nav-link" href="{{ route('alumni.index') }}">Daftar Alumni</a></li>
                </ul>
            </li>
            @endrole
            @role(['mahasiswa'])
            <li class="dropdown">
                <a href="{{ route('mahasiswa.show', Auth::user()->mahasiswa->id) }}"><i data-feather="user"></i><span>Profil</span></a>
            </li>
            @endrole

            @role(['super-admin', 'admin', 'mahasiswa'])
            <li class="menu-header">Kemahasiswaan</li>
            <li class="{{ isset($root) && $root == 'semester' ? 'active' : '' }}"><a href="{{ route('capaian-semester.index') }}"><i data-feather="archive"></i> <span>Capaian Semester</span></a></li>
            <li class="{{ isset($root) && $root == 'non-formal' ? 'active' : '' }}"><a href="{{ route('pendidikan-non-formal.index') }}"><i data-feather="activity"></i> <span>Pendidikan Non Formal</span></a></li>            
            <li class="{{ isset($root) && $root == 'ukm' ? 'active' : '' }}"><a href="{{ route('riwayat-ukm.index') }}"><i data-feather="compass"></i> <span>Riwayat UKM</span></a></li>
            <li class="{{ isset($root) && $root == 'prestasi' ? 'active' : '' }}"><a href="{{ route('prestasi.index') }}"><i data-feather="award"></i> <span>Prestasi</span></a></li>
            <li class="{{ isset($root) && $root == 'organisasi' ? 'active' : '' }}"><a href="{{ route('organisasi.index') }}"><i data-feather="share-2"></i> <span>Organisasi</span></a></li>
            @endrole
            
            @role(['super-admin', 'admin', 'mahasiswa'])
            <li class="menu-header">Dokumen & Surat</li>
            <li class="{{ isset($root) && $root == 'file' ? 'active' : '' }}"><a href="{{ route('files.index') }}"><i data-feather="briefcase"></i> <span>Manajemen Dokumen</span></a></li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i data-feather="paperclip"></i><span>Legalisir Dokumen</span></a>
                <ul class="dropdown-menu">
                    @role(['super-admin', 'admin'])
                    <li><a class="nav-link" href="{{ route('legalisir.create') }}">Buat Permohonan Legalisir</a></li>
                    @endrole                    
                    <li><a class="nav-link" href="{{ route('legalisir.index') }}">Daftar Permohonan Legalisir</a></li>
                </ul>
            </li>
            @endrole

            @role('super-admin')
            <li class="menu-header">Report</li>
            <li class="{{ isset($root) && $root == 'export' ? 'active' : '' }}"><a href="{{ route('export.index') }}"><i data-feather="layers"></i> <span>Eksport Data Mahasiswa</span></a></li>
            
            @endrole

            @role('super-admin')
            <li class="menu-header">Pengaturan</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i data-feather="user"></i><span>Pengguna</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('pengguna.index') }}">Semua Pengguna</a></li>
                    <li><a class="nav-link" href="{{ route('pengguna.create') }}">Hak Akses</a></li>
                </ul>
            </li>
            <li class="dropdown {{ isset($root) && $root == 'master' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i data-feather="server"></i><span>Data Master</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ isset($sub) && $sub == 'jurusan' ? 'active' : '' }}"><a class="nav-link" href="{{ route('master-jurusan.index') }}">Master Jurusan</a></li>
                    <li class="{{ isset($sub) && $sub == 'prodi' ? 'active' : '' }}"><a class="nav-link" href="{{ route('master-prodi.index') }}">Master Program Studi</a></li>
                    <li class="{{ isset($sub) && $sub == 'ukm' ? 'active' : '' }}"><a class="nav-link" href="{{ route('master-ukm.index') }}">Master UKM</a></li>
                    <li class="{{ isset($sub) && $sub == 'hak-akses' ? 'active' : '' }}"><a class="nav-link" href="{{ route('pengguna.create') }}">Hak Akses</a></li>
                </ul>
            </li>
            @endrole
        </ul>
    </aside>
</div>