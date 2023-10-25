@extends('layouts.base2')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{$kategori->nama_kategori}}</h1>
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

                    <div class="card-body" align="Center">
                        <h5 class="card-title"></h5>
                        {{-- ===== AWALAN FORM ===== --}}
                        <form action="{{url('produk_beli')}}" enctype="multipart/form-data" method="POST">
                            <div class="row">
                                @foreach ($produk as $prd)
                                @csrf
                                <div class="col-3">
                                    <div class="card text-left mb-3">
                                        <img src="{{ asset('storage/storage/' . $prd->foto_produk) }}"
                                            class="img-thumbnail" width="100%" height="100" alt="">
                                        <div class="card-body">
                                            <h5 class="card-title ">{{$prd->nama_produk}}</h5>
                                            <h6 class="card-title font-weight-bold">Rp{{ number_format($prd->harga, 0, ',', '.') }}</h6>
                                            <a href="{{url('produk_pembayaran')}}/{{$prd->id_produk}}"
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
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('assets/js/demo/chart-pie-demo.js')}}"></script>

</body>

</html>