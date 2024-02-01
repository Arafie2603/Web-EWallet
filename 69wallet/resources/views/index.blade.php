@include('layouts.include.head')
<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">
    <!-- Topbar Navbar -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon">
                <img src="{{ asset('assets/69wallet.png') }}" width="125px" alt="">
            </div>
        </a>
    </a>
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

</nav>

<div class="container">
    <!-- Nested Row within Card Body -->
    <div class="row d-flex justify-content-center">
        <div class="col-lg-7">
            <div class="p-5 m-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4 font-weight-bold">Buat akun !</h1>
                </div>
                <form method="post" action="{{ url('pendaftaran') }}" enctype="multipart/form-data" class="user">
                    @csrf
                    <div class="form-group">
                        @if (session('success'))
                            <div class="alert alert-success alert-dimissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert"><span>x</span></button>
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dimissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert"><span>x</span></button>
                                    {{ session('error') }}
                                </div>
                            </div>
                        @endif
                        <label for="name">Nama</label>
                        <input name="name" type="name"
                            class="form-control @error('name')
                                is-invalid
                            @enderror  form-control-user"
                            id="name" placeholder="Nama" value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto_ktp">Foto KTP</label>
                        <input name="foto_ktp" type="file"
                            class="form-control form-control-user @error('foto_ktp')
                                    is-invalid 
                                @enderror p-auto pb-5"
                            id="foto_ktp" placeholder="Foto KTP" value="{{ old('foto_ktp') }}">
                        @error('foto_ktp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_telp">No Telepon</label>
                        <input name="no_telp" type="no_telp"
                            class="form-control form-control-user @error('No Telepon')
                                    is-invalid
                                @enderror  "
                            id="no_telp" placeholder="Nomor Telepon" value="{{ old('No Telepon') }}">
                        @error('no_telp')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email"
                            class="form-control form-control-user @error('email')
                                    is-invalid
                                @enderror  "
                            id="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password"
                            class="form-control @error('password')
                                is-invalid
                            @enderror form-control-user"
                            id="exampleInputEmail" placeholder="password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>
