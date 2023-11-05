@extends('layouts.base')
@section('content')
    <div class="container-fluid">
        <!-- Telkomsel -->
        <div class="col-xl-12 col-md-6 mb-4">

            <div class=" h-100">

                <div class="card-body" align="Center">
                    <h5 class="card-title"></h5>
                    {{-- ===== AWALAN FORM ===== --}}
                    <form action="{{ url('produk_beli') }}" enctype="multipart/form-data" method="POST">
                        {{-- <div class="row">
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
                                @endforeach --}}
                        <div class="row">
                            @foreach ($produk as $prd)
                                <div class="card text-center m-3 mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <img src='{{ asset('storage/storage/' . $prd->foto_produk) }}' alt='Telkomsel'
                                                class='img-fluid' style='width: 300px;'> <br> <sub>Bayar:
                                                Rp.{{ number_format($prd->harga, 0, ',', '.') }} / {{ $prd->poin }}
                                                Point</sub> <br> <sub>(Bonus 3 point)</sub>

                                        </h5>
                                        <a href="{{ url('produk_pembayaran') }}/{{ $prd->id_produk }}"
                                            class="btn btn-primary btn-block">Beli</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
