@extends('layouts.base')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- DataTales Example -->

        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar User 69 Wallet</h6>
        </div> --}}

        {{-- ===== Button TAMBAH DATA ===== --}}

        <!-- Button trigger modal -->




        <div class="container-fluid p-0">
            <div class="row mr-2">
                @foreach ($kategori as $kate)
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">
                            <a class="card-text text-center text-decoration-none text-dark"
                                href="{{ url('produk_kategori') }}/{{ $kate->id_kategori }}">{{ $kate->nama_kategori }}</a>
                        </li>
                    </ul>
                @endforeach
            </div>

            <!-- Telkomsel -->
            <div class="col-xl-12 col-md-6 mb-4">

                <div class=" h-100">

                    <div class="card-body" align="Center">
                        <h5 class="card-title"></h5>
                        {{-- ===== AWALAN FORM ===== --}}
                        <form action="{{ url('produk_beli') }}" enctype="multipart/form-data" method="POST">
                            <div class="row">
                                @foreach ($produk as $prd)
                                    @csrf
                                    <div class="col-3">
                                        <div class="card text-left mb-3">
                                            <img src="{{ asset('storage/storage/' . $prd->foto_produk) }}"
                                                class="rounded-top" width="100%" height="150" alt="">
                                            <div class="card-body">
                                                <h5 class="card-title ">{{ $prd->nama_produk }}</h5>
                                                <h6 class="card-title font-weight-bold">
                                                    Rp{{ number_format($prd->harga, 0, ',', '.') }}</h6>
                                                <a href="{{ url('produk_pembayaran') }}/{{ $prd->id_produk }}"
                                                    class="btn btn-primary btn-block">Beli</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </form>



                    </div>

                </div>

            </div>

        </div>

    </div>



    </div>
@endsection
