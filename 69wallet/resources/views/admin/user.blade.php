@extends('layouts.base')
@section('content')
    {{-- =================ADMIN DASHBOARD============== --}}
    <div class="container-fluid">
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
                    <table class="table table-bord" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Saldo</th>
                                <th>Poin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_user as $dt)
                                <tr>
                                    <td class="text-center">
                                        {{ ($data_user->currentPage() - 1) * $data_user->perPage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $dt->name }}</td>
                                    <td>{{ $dt->email }}</td>
                                    <td>{{ $dt->role_id }}</td>
                                    @if ($dt->akun)
                                    <td>{{$dt->akun->saldo}}</td>
                                    <td>{{$dt->akun->poin}}</td>

                                    @else 
                                    <td>Pengguna belum memiliki akun</td>
                                    <td>Pengguna belum memiliki akun</td>
                                    @endif
                                    <td>
                                        <a href="#" class="btn btn-warning btn-icon-split" data-toggle="modal"
                                            data-target="#ubah_user{{ $dt->id }}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                            <span class="text">Ubah</span>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#hapus_user{{ $dt->id }}">
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
        @foreach ($data_user as $dt)
            <div class="modal fade" id="hapus_user{{ $dt->id }}" tabindex="-1" role="dialog"
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
                            <form action="{{ url('admin/user', $dt->id) }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" type="submit">hapus</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="ubah_user{{ $dt->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Data
                                Pengguna</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('admin/user') }}/{{ $dt->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mt-3">
                                    <input type="text" id="id" name="id" placeholder="Masukkan nomor id"
                                        class="form-control" required autocomplete="off" value="{{ $dt->id }}"
                                        maxlength="5" readonly>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" id="name" name="name" placeholder="Masukkan name staff"
                                        class="form-control" required autocomplete="off" value="{{ $dt->name }}">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="email" id="email" name="email" placeholder="Masukkan email"
                                        class="form-control" autocomplete="off" value="{{ $dt->email }}">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="number" step="any" id="saldo" name="saldo" placeholder="Masukkan saldo"
                                        class="form-control" autocomplete="off" value="{{ $dt->saldo }}">
                                </div>
                                <div class="form-group mt-3">
                                    <input type="number" step="any" id="poin" name="poin" placeholder="Masukkan poin"
                                        class="form-control" autocomplete="off" value="{{ $dt->poin }}">
                                </div>
                                <div class="form-group mt-3">
                                    <input id="password" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_baru" autocomplete="current-password"
                                        placeholder="Masukkan Password Baru">

                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Konfirmasi Password
                                                Salah</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <input id="password" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" autocomplete="current-password"
                                        placeholder="Masukkan Ulang Password">
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
        

        {{-- ===== MODAL TAMBAH ===== --}}
        @php

        @endphp
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah
                            Data User 69 Wallet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('admin/user') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group mt-3">

                                <input type="text" id="id" name="id" placeholder="Masukkan nomor id"
                                    value="{{ $lastId + 1}}" class="form-control" required autocomplete="off"
                                    pattern="[0-9]+" maxlength="5" disabled>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" id="name" name="name" placeholder="Masukkan nama anda"
                                    class="form-control" required autocomplete="off" pattern="[A-Za-z' ]+">
                            </div>
                            <div class="form-group mt-3">
                                <input type="email" id="email" name="email" placeholder="Masukkan email"
                                    class="form-control" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="number" id="saldo" name="saldo" placeholder="Masukkan saldo"
                                    class="form-control" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="number" id="poin" name="poin" placeholder="Masukkan poin"
                                    class="form-control" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" id="no_telp" name="no_telp" placeholder="Masukkan nomor telephone"
                                    class="form-control" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password" placeholder="Masukkan Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Konfirmasi Password Salah</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password_confirmation" required autocomplete="current-password"
                                    placeholder="Masukkan Ulang Password">
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
                Menampilkan {{ $data_user->firstItem() }} dari {{ $data_user->lastItem() }} hasil
            </div>
            <div class="dataTables_paginate paging_simple_numbers">
                {{ $data_user->links() }}
            </div>
        </div>

    </div>
@endsection
