@extends('layouts.base')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Kategori Produk</h1>
        <!-- DataTales Example -->

        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar User 69 Wallet</h6>
        </div> --}}

        {{-- ===== Button TAMBAH DATA ===== --}}

        <!-- Button trigger modal -->

        <div class="container-fluid p-0">


            <div class="row">
                @foreach ($kategori as $kate)
                    <div class="col-6 col-md-3">
                        <div class="card">
                            <a href="{{url('produk_kategori')}}/{{$kate->id_kategori}}"><img class="card-img-top responsive"
                                    style="object-fit:cover; width: 100%;height: 200px;"
                                    src="{{ asset('storage/storage/' . $kate->foto_kategori) }}" alt="Card image cap"></a>
                            <div class="card-body">
                                <p class="card-text text-center">{{ $kate->nama_kategori }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>



        </div>



    </div>
@endsection
