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
                        <div class="row">
                            @foreach ($produk as $prd)
                                <div class="card text-center m-3 mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <img src='{{ asset('storage/storage/' . $prd->foto_produk) }}' alt='Telkomsel'
                                                class='img-fluid' style='width: 300px;'>
                                                <br> 
                                                <sub>Bayar:
                                                Rp.{{ number_format($prd->harga, 0, ',', '.') }} / {{ $prd->poin }}
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
                                                @elseif($prd->harga == 25000)
                                                <sub>(Bonus 5 point)</sub>
                                                @endif
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