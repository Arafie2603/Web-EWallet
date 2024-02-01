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
                                <h5><span class="far fa-check-square pe-2"></span><b>69Wallet</b></h5>
                            </div>
                            <h4 class="text-success">Rp{{ number_format($produk->harga, 0, ',', '.') }}</h4>
                            <h4>{{ $produk->nama_produk }}</h4>
                            @if ($kategori[0]->nama_kategori ==  'Pulsa') 
                            <p>
                                Paket yang sangat menghemat kantong anda
                            </p>
                            @else
                            <p>Layanan ini sangat menarik</p>
                            @endif

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
                                            <input type="text" hidden name="id_kategori" value="{{ $produk->kategori_id }}">
                                        </div>
                                    </div>
                                    <select disabled class="form-control select2 mx-auto mt-2" style="width: 100%"
                                        name="id_reward" id="id_reward">
                                        <option selected disabled value="">
                                            Pilih voucher anda</option>
                                        <option value="">
                                            tidak memilih
                                        </option>
                                        @foreach ($redtail as $rw)
                                        @if ($rw->status == 'tidak terpakai')
                                            <option value="{{ $rw->id_reward_detail }}">
                                                {{ $rw->nama_reward }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @if ($produk->kategori_id == 2) 
                                    <button disabled value="{{ $produk->id_produk }}" type="submit"
                                        class="btn btn-primary btn-block btn-lg mt-3 buyBtn">
                                        Bayar
                                    </button>
                                    @else
                                    <button value="{{ $produk->id_produk }}" type="submit"
                                        class="btn btn-primary btn-block btn-lg mt-3">
                                        Bayar
                                    </button>

                                    @endif
                                    
                            </div>
                        </div>

                        <div class="col-md-5 col-xl-4 offset-xl-1">
                            <div class="py-4 d-flex justify-content-end">
                                <h6><a href="{{ route('dashboard_user.index') }}">Kembali ke halaman utama</a></h6>
                            </div>
                            <div class="rounded d-flex flex-column borde mb-3" style="background-color: #f8f9fa;">
                                <img class="rounded-top" src="{{ asset('storage/storage/' . $produk->foto_produk) }}"
                                    alt="" width="100%">

                                <div class="p-2 me-3">
                                </div>
                                @foreach ($kategori as $kate)      
                                    @if ($kate->nama_kategori == 'Pulsa')
                                    <div class="p-2 d-flex">
                                        <input type="text" class="form-control" id="phone" name="phone" value=""
                                            placeholder="Masukan nomor telepon">
                                    </div>
                                    @endif
                                @endforeach
                                <div id="phone-error" class="text-danger"></div>
                                <div class="p-2 d-flex">
                                </div>

                            </div>
                        </div>
                        </form>
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
            <script>
                $('.buyBtn').prop('disabled', true);
                // Validasi nomor HP saat input
                $('#phone').on('input', function() {
                    var phoneNumber = $(this).val().trim();
                    var isValid = /^(\+62|08)[0-9]{9,}$/.test(phoneNumber);
                    $('.buyBtn').prop('disabled', !isValid);
                    $('#phone-error').text(isValid ? '' : 'Masukkan nomor HP yang valid (awalan 08 atau +62)');
                });

                // Handler saat tombol "Beli" di klik
                $('.buyBtn').click(function(event) {
                    if ($(this).prop('disabled')) {
                        event.preventDefault(); // Mencegah perilaku default dari tautan saat dinonaktifkan
                        $('#phone-error').text('Mohon isi nomor HP yang valid sebelum melakukan pembelian.');
                        return false; // Menghentikan aksi default
                    }
                });

                $(document).ready(function() {
                    $('#payment-option1').click(function() {
                        $('#id_reward').prop('disabled', false);
                    });
                    $('#payment-option2').click(function() {
                        $('#id_reward').prop('disabled', true);
                    });
                });
            </script>
            </body>

            </html>

            </html>
