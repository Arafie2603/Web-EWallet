@extends('layouts.base')
@section('content')
    {{-- ================= ADMIN PRODUK ============== --}}
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Reward</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar User 69 Wallet</h6>
            </div> --}}

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dimissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert"><span>x</span></button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning alert-dimissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert"><span>x</span></button>
                            {{ session('warning') }}
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
                    <a href="#" class="btn btn-primary btn-icon-split mb-3" data-toggle="modal"
                        data-target="#exampleModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Data</span>
                    </a>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Reward</th>
                                <th>Nama Reward</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reward as $index=> $rw)
                                <tr>
                                    <td class="text-center">
                                        {{ ++$index }}
                                    </td>
                                    <td>{{ $rw->nama_reward }}</td>
                                    <td>{{ $rw->harga_poin }}</td>
                                    <td>{{ $rw->nilai_reward }}</td>

                                    <td>
                                        <a href="#" class="btn btn-warning btn-icon-split" data-toggle="modal"
                                            data-target="#ubah_user{{ $rw->id_reward }}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                            <span class="text">Ubah</span>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#hapus_user{{ $rw->id_reward }}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Hapus</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- =====MODAL BOX UP & DEL===== --}}
        {{-- ===== DELETE ===== --}}
        @foreach ($reward as $rw)
            <div class="modal fade" id="hapus_user{{ $rw->id_reward }}" tabindex="-1" role="dialog"
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
                            <form action="{{ url('admin/rewards', $rw->id_reward) }}" method="POST"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" type="submit">hapus</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            {{-- ===== UPDATE ===== --}}
            <div class="modal fade" id="ubah_user{{ $rw->id_reward }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah data produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('rewards.update',$rw->id_reward) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mt-3">
                                    <input type="text" id="nama_reward" name="nama_reward"
                                        placeholder="Masukkan nama reward" class="form-control" required autocomplete="off"
                                        value="{{ $rw->nama_reward }}">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" id="harga_poin" name="harga_poin"
                                        placeholder="Masukkan nama reward" class="form-control" required autocomplete="off"
                                        value="{{ $rw->harga_poin }}">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="number" step="0.01" id="nilai_reward" name="nilai_reward" placeholder="Masukkan nilai reward"
                                    value="{{ $rw->nilai_reward }}" class="form-control" required autocomplete="off">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <input type="hidden" name="_method" value="PUT">
                                <button class="btn btn-warning" type="submit">Ubah</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        @endforeach

        {{-- ===== MODAL TAMBAH PRODUK ===== --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ url('admin/rewards') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group mt-3">
                                <input type="text" id="nama_reward" name="nama_reward"
                                    placeholder="Masukkan nama reward" value="" class="form-control" required
                                    autocomplete="off">
                            </div> 
                            
                            <div class="form-group mt-3">
                                <input type="number" id="harga_poin" name="harga_poin" placeholder="Masukkan harga produk"
                                    value="" class="form-control" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="number" step="0.01" id="nilai_reward" name="nilai_reward" placeholder="Masukkan nilai reward"
                                    value="" class="form-control" required autocomplete="off">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </div>
                </form>

            </div>
        </div>
        <!-- Paginate di bawah tabel -->
        <div class="d-flex justify-content-between">
            <div class="dataTables_info">
                Menampilkan {{ $reward->firstItem() }} dari {{ $reward->lastItem() }} hasil
            </div>
            <div class="dataTables_paginate paging_simple_numbers">
                {{ $reward->links() }}
            </div>
        </div>

    </div>
@endsection
