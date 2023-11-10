@extends('layouts.base')
@section('content')
    <br>
    <div id="content-wrapper" class="d-flex flex-column align-self-center">
        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Profile Card -->
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <div class="card shadow mb-4 d-flex " style="width: 60%">
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
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('storage/storage/' . session()->get('image')) }}" width="200px">
                                </div>
                                <form>

                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ session('name') }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ session('email') }}" readonly>
                                    </div>
                                </form>
                                <a href="#" data-toggle="modal" data-target="#exampleModal"
                                    class="btn btn-primary btn-user btn-block">
                                    Edit Profile
                                </a>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>

        {{-- ===== Modal Edit Profile ===== --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ url('update_profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="text-center mb-3">
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('storage/storage/' . session()->get('image')) }}" width="200px"
                                    id="profile-image" alt="Foto Profil">
                            </div>
                            <div class="d-flex justify-content-center">
                                <label for="image" class="btn btn-primary align-items-center">Upload</label>
                                <input hidden id="image" type="file" name="image" class="form-control">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" id="name" name="name" placeholder="Masukkan nama produk"
                                    value="{{ session('name') }}" class="form-control" required autocomplete="off">
                            </div>
                            <div class="form-group mt-3">
                                <input type="email" id="email" name="email" placeholder="Masukkan harga produk"
                                    value="{{ session('email') }}" class="form-control" required autocomplete="off">
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
    </div>
@endsection
