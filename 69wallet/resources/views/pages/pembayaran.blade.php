@extends('layouts.base')

@section('content')
    <section style="">
        <div class="container py-5">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center pb-5">
                        <div class="col-md-7 col-xl-5 mb-4 mb-md-0">
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
                            <div class="py-4 d-flex flex-row">
                                <h5><span class="far fa-check-square pe-2"></span><b>69Wallet</b> |</h5>
                                <span class="ps-2">Pay</span>
                            </div>
                            <h4 class="text-success">Rp{{ number_format($produk->harga, 0, ',', '.') }}</h4>
                            <h4>{{ $produk->nama_produk }}</h4>

                            <p>
                                Paket yang sangat menghemat kantong anda
                            </p>

                            <div class="pt-2">
                                <form class="pb-3" form action="{{ url('pembayaran') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex flex-row pb-3">
                                        <div class="d-flex align-items-center pe-2">
                                            <input type="radio" id="payment-option1" name="payment"
                                                class="form-check-input" value="saldo">
                                        </div>
                                        <div class="rounded border d-flex w-100 p-3 align-items-center">
                                            <p class="mb-0">
                                                </i>Saldo
                                            </p>
                                            <div class="ms-auto">&nbsp;({{ $produk->harga }})</div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row">
                                        <div class="d-flex align-items-center pe-2">
                                            <input type="radio" id="payment-option2" name="payment"
                                                class="form-check-input" value="poin">
                                        </div>
                                        <div class="rounded border d-flex w-100 p-3 align-items-center">
                                            <p class="mb-0">
                                                Poin
                                            </p>
                                            <div class="ms-auto">&nbsp;({{ $produk->poin }})</div>
                                        </div>
                                        <div class="form-group mt-3">

                                            <input type="number" id="harga" name="harga"
                                                placeholder="Masukkan nomor id" value="{{ $produk->harga }}"
                                                class="form-control w-25 mb-2" required autocomplete="off" pattern="[0-9]+"
                                                maxlength="5" hidden>
                                            <input type="number" id="poin" name="poin"
                                                placeholder="Masukkan nomor id" value="{{ $produk->poin }}"
                                                class="form-control w-25" required autocomplete="off" pattern="[0-9]+"
                                                maxlength="5" hidden>

                                            <input type="number" id="id_produk" name="id_produk"
                                                placeholder="Masukkan nomor id" value="{{ $produk->id_produk }}"
                                                class="form-control w-25" required autocomplete="off" pattern="[0-9]+"
                                                maxlength="5" hidden>
                                        </div>
                                    </div>

                                    <button value="{{ $produk->id_produk }}" type="submit"
                                        class="btn btn-primary btn-block btn-lg mt-3">
                                        Bayar
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-5 col-xl-4 offset-xl-1">
                            <div class="py-4 d-flex justify-content-end">
                                <h6><a href="{{route('dashboard_user.index')}}">Cancel and return to website</a></h6>
                            </div>
                            <div class="rounded d-flex flex-column border" style="background-color: #f8f9fa;">
                                <img class="rounded-top" src="{{ asset('storage/storage/' . $produk->foto_produk) }}"
                                    alt="" width="100%">
                                @if ($produk->kategori_id == 1)
                                    <div class="p-2 me-3">
                                    </div>
                                    <div class="p-2 d-flex">
                                        <div class="col-8">Nomor Telepon</div>
                                        <div class="ms-auto">{{ $user->akun->no_telp }}</div>
                                    </div>
                                    <div class="p-2 d-flex">
                                        <div class="col-8">Harga poin</div>
                                        <div class="ms-auto">{{ $produk->poin }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                    <a class="btn btn-primary" href="{{ route('logout') }}">Keluar</a>
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
