@extends('layouts.base2')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800"></h1>
        <!-- DataTales Example -->

        {{-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar User 69 Wallet</h6>
    </div> --}}

        {{-- ===== Button TAMBAH DATA ===== --}}

        <!-- Button trigger modal -->

        <div class="container-fluid p-0">
            <div class="row">

                <!-- Telkomsel -->
                <div class="col-xl-12 col-md-6 mb-4">

                    <div class="card border-left-primary shadow h-100">
                        <div class="card">
                            <div class="card">
                                <div class="card-header">
                                    Informasi Rincian Pembelian
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
                                @if ($produk->kategori_id == 1)

                                {{-- {{dd($produk->kategori_id)}} --}}
                                    
                                <div class="card-body">
                                    <p>Produk &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $produk->nama_produk }}</p>
                                    <p>Harga &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                                    <p>Tukar poin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$produk->poin}}</p>
                                    <p>No Telephone : {{$user->akun->no_telp}}</p>
                                </div>
                                @elseif ($produk->kategori_id == 2)
                                <div class="card-body">
                                    <p>Produk: {{ $produk->nama_produk }}</p>
                                    <p>Harga: Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                                    <p>Tukar poin : {{$produk->poin}}</p>
                                </div>
                                    
                                @endif
                                <div class="p-4">
                                    <form action="{{ url('pembayaran') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
        
                                        <label for="">Pilih metode pembayaran : </label>
                                        
                                            <div class="form-check">
                                                <input type="radio" id="payment-option1" name="payment" class="form-check-input"
                                                    value="saldo">
                                                <label class="form-check-label" for="payment-option1">Saldo</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="payment-option2" name="payment" class="form-check-input"
                                                    value="poin">
                                                <label class="form-check-label" for="payment-option2">Poin</label>
                                            </div>
                                            <div class="form-group mt-3">
        
                                                <input type="number" id="harga" name="harga" placeholder="Masukkan nomor id"
                                                    value="{{ $produk->harga }}" class="form-control w-25 mb-2" required autocomplete="off"
                                                    pattern="[0-9]+" maxlength="5" hidden>
                                                <input type="number" id="poin" name="poin" placeholder="Masukkan nomor id"
                                                    value="{{ $produk->poin }}" class="form-control w-25" required autocomplete="off"
                                                    pattern="[0-9]+" maxlength="5" hidden>
        
                                                <input type="number" id="id_produk" name="id_produk" placeholder="Masukkan nomor id"
                                                    value="{{ $produk->id_produk }}" class="form-control w-25" required autocomplete="off"
                                                    pattern="[0-9]+" maxlength="5" hidden>
                                            </div>
                                    
                                        <button value="{{$produk->id_produk}}" type="submit" class="btn btn-primary btn-block w-25 mt-2">
                                            Bayar
                                        </button>
        
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>


    </div>



    </div>
    <!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin keluar ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <a class="btn btn-primary" href="{{route('logout')}}">Keluar</a>
    </div>
@endsection

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>

</html>
