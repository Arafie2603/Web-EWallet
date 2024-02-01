@extends('layouts.base')

@section('content')
    <div class="container-fluid">
        <!-- Telkomsel -->
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="h-100">
                <div class="card-body" align="Center">
                    <h5 class="card-title"></h5>
                    
                    {{-- Formulir Pencarian --}}
                    <form action="{{ url('search') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Produk">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>

                    {{-- Tampilkan Produk --}}
                    <div class="row">
                        @foreach ($produk as $prd)
                            <div class="card text-center m-3 mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <img src='{{ asset('storage/storage/' . $prd->foto_produk) }}' alt='Telkomsel'
                                            class='img-fluid' style='width: 300px; height: 150px'>
                                        <br> 
                                        <h3>{{ $prd->nama_produk }}</h3>
                                        <sub>Rp.{{ number_format($prd->harga, 0, ',', '.') }} / {{ $prd->poin }}
                                            Point</sub> 
                                        <br> 
                                        @if ($prd->harga == 5000)
                                            <sub>(Bonus 1 point)</sub>
                                        @elseif($prd->harga == 10000)
                                            <sub>(Bonus 2 point)</sub>
                                        @elseif($prd->harga == 15000)
                                            <sub>(Bonus 3 point)</sub>
                                        @elseif($prd->harga == 20000)
                                            <sub>(Bonus 4 point)</sub>
                                        @elseif($prd->harga >= 25000)
                                            <sub>(Bonus 5 point)</sub>
                                        @endif
                                    </h5>
                                    <a href="{{ url('produk_pembayaran') }}/{{ $prd->id_produk }}"
                                        class="btn btn-primary btn-block">Beli</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
