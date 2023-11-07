@extends('layouts.base')

@section('content')
    <div class="container-fluid">
        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Point</h1>
    </div> --}}
        <div class="row">
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary mb-4">
                                    <h4 class="font-weight-bold text-success" style="">My Point</h4>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user->akun->poin }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-donate fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Rewards</h1>
        </div>
        @if (session('error'))
            <div class="alert alert-danger alert-dimissible show fade m-2">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>x</span></button>
                    {{ session('error') }}
                </div>
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning alert-dimissible show fade m-2">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>x</span></button>
                    {{ session('warning') }}
                </div>
            </div>
        @endif

    </div>
    <div class="col-xl-12 col-md-6 mb-4">

        <div class=" h-100">

            <div class="card-body" align="Center">
                <h5 class="card-title"></h5>
                {{-- ===== AWALAN FORM ===== --}}
                <form action="{{ url('reedem') }}" enctype="multipart/form-data" method="POST">
                    <div class="row">
                        @foreach ($produk as $prd)
                            @csrf
                            <div class="col-3">
                                <div class="card text-left mb-3">
                                    <form action="{{ url('reedem') }}" enctype="multipart/form-data">
                                        @csrf
                                        {{ method_field('PUT') }}

                                        <div class="card-body">
                                            <h5 class="card-title ">{{ $prd->nama_produk }}</h5>
                                            <p class="card-text">
                                                <small class="text-muted">Harga: {{ $prd->poin }} Poin</small>
                                            </p>
                                            <div class="form-group mt-3">
                                                <input type="number" id="reedem" name="reedem"
                                                    value="{{ $prd->poin }}" class="form-control" required
                                                    autocomplete="off" hidden>
                                            </div>
                                            <div class="form-group mt-3">
                                                <input type="number" id="no_telp" name="no_telp"
                                                    value="{{ $user->akun->no_telp }}" class="form-control" required
                                                    autocomplete="off" hidden>
                                            </div>
                                            <button value="{{ $prd->id_produk }}" type="submit"
                                                class="btn btn-primary btn-block btn-lg mt-3">
                                                Reedem
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                </form>



            </div>

        </div>
    </div>


    </div>
    </div>

    {{-- ===== Modal Reedem =====
    <div class="modal fade" id="reedemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin melakukan reedem produk ?
                        </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ url('reedem') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group mt-3">
                                <input type="number" id="reedem" name="reedem" value="{{ $prd->poin }}"
                                    class="form-control" required autocomplete="off" hidden>
                            </div>
                            <div class="form-group mt-3">
                                <input type="number" id="no_telp" name="no_telp" value="{{ $user->akun->no_telp }}"
                                    class="form-control" required autocomplete="off" hidden>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <input type="hidden" name="_method" value="PUT">
                            <button class="btn btn-primary" type="submit">Iya</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div> --}}
@endsection
