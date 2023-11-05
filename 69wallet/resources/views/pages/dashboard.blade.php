@extends('layouts.base')

@section('content')
    <div class="container-fluid">
        {{-- ===== DASHBOARD USER ===== --}}
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hai, {{ session('name') }}</h1>
        </div>
        <a href="#" class="btn btn-success btn-icon-split mb-3" data-toggle="modal" data-target="#exampleModal">
            <span class="icon text-white-50">
                <i class="fas fa-dollar-sign"></i>
            </span>
            <span class="text">Top up</span>
        </a>
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
        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow py-2 h-150">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary mb-4">
                                    <h4 class="font-weight-bold" style="">Saldo</h4>
                                </div>
                                {{-- 
                                @if ($user->akun->saldo == 0)
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp. {{ number_format(0, 0, ',', '.') }}
                                    </div>
                                @else --}}
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp. {{ number_format($user->akun->saldo, 0, ',', '.') }}
                                </div>
                                {{-- @endif --}}


                            </div>
                            {{-- <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow py-2 h-150">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success mb-4">
                                    <h4 class="font-weight-bold" style="">Poin</h4>
                                </div>
                                {{-- 
                                @if ($user->akun->saldo == 0)
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp. {{ number_format(0, 0, ',', '.') }}
                                    </div>
                                @else --}}
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $user->akun->poin }}
                                </div>
                                {{-- @endif --}}


                            </div>
                            {{-- <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-100">

                <div class="card-body">
                    {{-- ===== AWALAN FORM ===== --}}

                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">

                        <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="text-decoration-none card-title text-dark font-weight-bold mr-auto">Recent Transaction</h5>
                                    <a href="{{ url('history') }}" class="btn-btn mb-3 text-decoration-none">
                                        <span class="icon text-white-50">

                                        </span>
                                        <span class="text-dark pr-4">View all <i class="fas fa-chevron-right"></i></span>
                                    </a>
                                </div>
                            <tbody>
                                {{-- {{ dd($transa[0]) }} --}}
                                @if ($transa[0] == null)
                                <th class="text-light">Image</th>                            
                                <th class="text-light">Nama produk</th>                            
                                <th class="text-light">Date</th>                            
                                <th class="text-light">No telp</th>                            
                                <th class="text-light">Harga</th>                            
                                @endif
                                @foreach ($transa as $index => $td)
                                    <tr>
                                        <td><img src="{{ asset('storage/storage/' . $td->foto_produk) }}"
                                                class="img-thumbnail" width="100" height="100" alt=""></td>
                                        <td>{{ $td->nama_produk }}</td>
                                        <td>{{ $date[$index] }}</td>
                                        <td>{{ $user->akun->no_telp }}</td>
                                        <td>-Rp{{ number_format($td->harga, 0, ',', '.') }}</td>
                                        <td>+{{ $td->reward_poin }}</td>
                                        <td>{{ $td->status }}</td>
                                        <td>  <a href="{{ url('detail_receipt') }}/{{ $td->id_transaksi_detail }}"
                                            class="">Receipt</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </div>
                    </table>
                    {{-- <div class="dataTables_paginate paging_simple_numbers">
                        {{ $transa->links() }}
                    </div> --}}
                </div>
            </div>
        </div>

    </div>

    </div>
    </div>

    {{-- ===== MODAL TAMBAH SALDO (TOP UP) ===== --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Top up saldo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('top_up') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group mt-3">
                            <input type="password" id="password" name="password" placeholder="Masukkan password anda"
                                value="" class="form-control" required autocomplete="off">
                        </div>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>Konfirmasi Password
                                    Salah</strong>
                            </span>
                        @enderror
                        <div class="form-group mt-3">
                            <select class="form-control select2 mx-auto mt-2" style="width: 100%" name="saldo"
                                id="saldo" required>
                                <option selected disabled value="">
                                    Pilih nominal saldo</option>
                                <option value="10000">10000</option>
                                <option value="20000">20000</option>
                                <option value="50000">50000</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <input type="hidden" name="_method" value="PUT">
                        <button class="btn btn-primary" type="submit">Top up</button>
                    </div>
            </div>
            </form>

        </div>
    </div>

    {{-- ===== Modal History all ===== --}}
@endsection
