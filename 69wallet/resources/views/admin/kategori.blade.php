@extends('layouts.base')

@section('content')
    {{-- ================= ADMIN KATEGORI ============== --}}
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Kategori Produk</h1>
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
                @if (session('info'))
                    <div class="alert alert-info alert-dimissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert"><span>x</span></button>
                            {{ session('info') }}
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
                                <th>Nama</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $kate)
                                <tr>
                                    <td class="text-center">
                                        @php
                                            $i = 1;
                                            echo $i;
                                            $i++;
                                        @endphp
                                    </td>
                                    <td>{{ $kate->nama_kategori }}</td>
                                    @if ('success')
                                        <td><img src="{{ asset('storage/storage/' . $kate->foto_kategori) }}"
                                                class="img-thumbnail" width="100" height="100" alt=""></td>
                                    @endif
                                    <td>
                                        <a href="#" class="btn btn-warning btn-icon-split" data-toggle="modal"
                                            data-target="#ubah_user{{ $kate->id_kategori }}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                            <span class="text">Ubah</span>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#hapus_user{{ $kate->id_kategori }}">
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
        @foreach ($kategori as $kate)
            <div class="modal fade" id="hapus_user{{ $kate->id_kategori }}" tabindex="-1" role="dialog"
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
                            <form action="{{ url('admin/kategori', $kate->id_kategori) }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" type="submit">hapus</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            {{-- ===== UPDATE ===== --}}
            <div class="modal fade" id="ubah_user{{ $kate->id_kategori }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data
                                Staff Kasir</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('kategori.index') }}/{{ $kate->id_kategori }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mt-3">
                                    <input type="text" id="nama_kategori" name="nama_kategori"
                                        placeholder="Masukkan name staff" class="form-control" required autocomplete="off"
                                        value="{{ $kate->nama_kategori }}">
                                </div>
                                <div class="form-group mt-3">
                                    <div class="form-group mt-3">
                                        <input id="foto_kategori" type="file" name="foto_kategori"
                                            class="form-control">
                                        @error('foto_kategori')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
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
                    <form method="POST" action="{{ url('admin/kategori') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mt-3">
                                <input type="text" id="nama_kategori" name="nama_kategori"
                                    placeholder="Masukkan nama kategori" value="" class="form-control" required
                                    autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input id="foto_kategori" type="file" name="foto_kategori" class="form-control">
                                @error('foto_kategori')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
                Menampilkan {{ $kategori->firstItem() }} dari {{ $kategori->lastItem() }} hasil
            </div>
            <div class="dataTables_paginate paging_simple_numbers">
                {{ $kategori->links() }}
            </div>
        </div>

    </div>
@endsection
