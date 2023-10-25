@extends('layouts.base')
@section('content')
    {{-- ================= ADMIN PRODUK ============== --}}
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Produk</h1>
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
                                <th>Nama Produk</th>
                                <th>Kode</th>
                                <th>Kategori</th>
                                <th>Foto</th>
                                <th>Harga saldo</th>
                                <th>Harga poin</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $prod)
                                <tr>
                                    <td class="text-center">
                                        {{ ($produk->currentPage() - 1) * $produk->perPage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $prod->nama_produk }}</td>
                                    <td>{{ $prod->kode_produk }}</td>
                                    <td>{{ $prod->kategori->nama_kategori }}</td>

                                    @if ('success')
                                        <td><img src="{{ asset('storage/storage/' . $prod->foto_produk) }}"
                                                class="img-thumbnail" width="100" height="100" alt=""></td>
                                    @endif
                                    <td>Rp{{ number_format($prod->harga) }}</td>
                                    <td>{{ $prod->poin }}</td>
                                    <td>{{ $prod->status }}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-icon-split" data-toggle="modal"
                                            data-target="#ubah_user{{ $prod->id_produk }}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                            <span class="text">Ubah</span>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#hapus_user{{ $prod->id_produk }}">
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
        @foreach ($produk as $prod)
            <div class="modal fade" id="hapus_user{{ $prod->id_produk }}" tabindex="-1" role="dialog"
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
                            <form action="{{ url('admin/kategori', $prod->id_produk) }}" method="POST"
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
            <div class="modal fade" id="ubah_user{{ $prod->id_produk }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah data produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('produk.update',$prod->id_produk) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mt-3">
                                    <input type="text" id="nama_produk" name="nama_produk"
                                        placeholder="Masukkan name staff" class="form-control" required autocomplete="off"
                                        value="{{ $prod->nama_produk }}">
                                </div>
                                <div class="form-group mt-3">
                                    <div class="form-group mt-3">
                                        <input id="foto_produk" type="file" name="foto_produk" class="form-control">
                                        @error('foto_produk')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="number" id="harga" name="harga" placeholder="Ubah harga produk"
                                        value="{{$prod->harga}}" class="form-control" required autocomplete="off">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="number" id="poin" name="poin" placeholder="Ubah poin produk"
                                        value="{{$prod->poin}}" class="form-control" required autocomplete="off">
                                </div>
                                <div class="form-group mt-3">
                                    <select class="form-control select2 mx-auto mt-2" style="width: 100%" name="status"
                                        id="status" required>
                                        <option selected disabled value="">
                                            Pilih Status</option>
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Kosong">Kosong</option>
                                    </select>
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
                    <form method="POST" action="{{ url('admin/produk') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group mt-3">
                                <input type="text" id="nama_produk" name="nama_produk"
                                    placeholder="Masukkan nama produk" value="" class="form-control" required
                                    autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <select class="form-control select2 mx-auto mt-2" style="width: 100%" name="kategori_id"
                                    id="kategori" required>
                                    <option selected disabled value="">
                                        Pilih Kategori</option>
                                    @foreach ($kategori as $kate)
                                        <option value="{{ $kate->id_kategori }}">
                                            {{ $kate->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <input id="foto_produk" type="file" name="foto_produk" class="form-control">
                                @error('foto_produk')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <input type="number" id="harga" name="harga" placeholder="Masukkan harga produk"
                                    value="" class="form-control" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="number" id="poin" name="poin" placeholder="Masukkan poin produk"
                                    value="" class="form-control" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <select class="form-control select2 mx-auto mt-2" style="width: 100%" name="status"
                                    id="status" required>
                                    <option selected disabled value="">
                                        Pilih Status</option>
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Kosong">Kosong</option>
                                </select>
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
                Menampilkan {{ $produk->firstItem() }} dari {{ $produk->lastItem() }} hasil
            </div>
            <div class="dataTables_paginate paging_simple_numbers">
                {{ $produk->links() }}
            </div>
        </div>

    </div>
@endsection
