@extends('layouts.base')

@section('content')
    {{-- =================ADMIN============== --}}
    <div class="container-fluid">
        {{-- {{ Route::current()->getName() }} --}}
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-betwween mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hai, {{ session('name') }}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary mb-1">
                                    <h6> Jumlah User</h6>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                </div>

                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Saldo</div>




                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
        </div>
    </div>
@endsection
