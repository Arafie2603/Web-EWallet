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
                                    {{ session('jumlah_user') }}
                                </div>

                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary mb-1">
                                    <h6> Jumlah Produk</h6>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ session('jumlah_produk') }}
                                </div>

                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary mb-1">
                                    <h6> Jumlah Rewards</h6>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ session('jumlah_reward') }}
                                </div>

                            </div>
                            <div class="col-auto">
                                <i class="fas fa-medal fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
        </div>
        <div class="card-body">
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
            <div class="table-responsive">
                {{-- ===== Button TAMBAH DATA ===== --}}
                <table class="table table-bord" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Foto KTP</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarUser as $dt)
                        @php
                            $jumlah = 0;
                        @endphp
                            <tr>
                                @if ($dt->status == 'belum verifikasi')   
                                    <td class="text-center">
                                        {{ ++$jumlah }}
                                    </td>
                                    <td>{{ $dt->name }}</td>
                                    <td>{{ $dt->email }}</td>
                                    <td>{{ $dt->status }}</td>
                                    <td><a href="{{ url('admin/lihat_ktp', $dt->id) }}">Lihat</a></td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal"
                                            data-target="#hapus_user{{ $dt->id }}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="text">Verifikasi</span>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @foreach ($daftarUser as $usr)
        <div class="modal fade" id="hapus_user{{ $usr->id }}" tabindex="-1" role="dialog"
            aria-labelledby="hapus-siswa" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus data?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus
                            data?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <form action="{{ url('admin/lihat_ktp',$usr->id) }}" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <button class="btn btn-danger" type="submit">hapus</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
            
        @endforeach
        <!-- Paginate di bawah tabel -->
        <div class="d-flex justify-content-between">
            <div class="dataTables_info">
                Menampilkan {{ $daftarUser->firstItem() }} dari {{ $daftarUser->lastItem() }} hasil
            </div>
            <div class="dataTables_paginate paging_simple_numbers">
                {{ $daftarUser->links() }}
            </div>
        </div>
    </div>
@endsection
