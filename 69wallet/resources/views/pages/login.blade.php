@include('layouts.include.head')


<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow">
    <!-- Topbar Navbar -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/logo.png') }}" alt="">
        </div>
        <div class="sidebar-brand-text mx-3 text-primary font-weight-bold">69 Wallet</div>
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

    <div class="row d-flex justify-content-center">
        <div class="col-lg-7">
            <div class="p-5 m-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4 font-weight-bold">WELCOME BACK !</h1>
                    <div>Dont have an account, <a href="{{ url('/pendaftaran') }}">Sign up</a></div>
                </div>
                <form method="POST" action="{{ url('daftar') }}" enctype="multipart/form-data" class="user">
                    @csrf
                    <div class="form-group w-80">
                        @if (session('success'))
                            <div class="alert alert-success alert-dimissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert"><span>x</span></button>
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif
                        <label for="email"></label>
                        <input name="email" type="email" class="form-control form-control-user" id="email"
                            placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" class="form-control form-control-user"
                            id="exampleInputEmail" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                    <div>

                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
