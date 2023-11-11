@extends('layouts.base2')


@section('content3')
    <main class="content" style="width: 500px; margin:auto;padding-top: 40px">
        <!-- Button trigger modal -->
        <div class="container-fluid p-0">
            <strong>
                <div class="row">

                    <div class="col-xl-12 d-flex mb-5 d-flex justify-content-center">
                        <div class="">
                            <div class="row">
                                <div class="col-sm-12" style="width: 500px">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <h1 class="text-center">69 Wallet</h1>
                                            <p class="text-center">Jl. Taman Melati, Bekasi, West Java
                                                <br>(021)8475937582
                                            </p>
                                            <p class="text-center"></p>
                                            {{ str_pad('', 45, '=') }}
                                            <table>
                                                <tr>
                                                    <td>OrderID</td>
                                                    <td>: {{ $transaksiDetail[0]->transaksi_id }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah</td>
                                                    <td>: {{ $transaksiDetail[0]->total_item }} SKU</td>
                                                </tr>
                                                <tr>
                                                    <td>Reward</td>
                                                    <td>: +{{ $transaksiDetail[0]->reward_poin }} poin</td>
                                                </tr>
                                            </table>
                                            {{ str_pad('', 45, '=') }}

                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="width: 40%">{{ $transaksiDetail[0]->nama_produk }}</td>
                                                    <td style="width: 40%"></td>
                                                    <td>Rp{{ number_format($transaksiDetail[0]->harga_satuan * $transaksiDetail[0]->jumlah) }}
                                                    </td>
                                                </tr>
                                                @if ($selisih != 0)
                                                    <tr>
                                                        <td style="width: 60%">Potongan </td>
                                                        <td style="width: 30%"></td>
                                                        <td>-Rp{{ number_format($selisih) }}
                                                        </td>
                                                    </tr>
                                                @endif

                                            </table>
                                            <br>
                                            {{ str_pad('', 45, '=') }}
                                            <div class="d-flex justify-content-between">
                                                <p>Total :</p>
                                                <p>Rp.{{ number_format($transaksiDetail[0]->total_harga) }}</p>
                                            </div>
                                            <p class="text-center pt-5">Terimakasih dan semoga harimu menyenangkan!</p>
                                            {{-- <div class="d-flex justify-content-center">{!! DNS1D::getBarcodeHTML($transaksi->id_transaksi, 'C128', 3, 60) !!}</div> --}}
                                            <p class="text-center pt-3"></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- {{ dd($poin_achieve) }} --}}
                <form action="{{ url('dash_poin') }}" enctype="multipart/form-data" method="POST">
                    <div class="d-flex justify-content-center mb-5">
                        <input id="poin_achieve" name="poin_achieve"value="3" class="form-control w-25 mb-2" hidden>
                        <a class="btn btn-primary" value="" href="{{ url('dash_poin') }}"
                            type="submit"><i class="fas fa-home"></i>
                            Kembali ke halaman utama</a>
                    </div>
                </form>

        </div>
    </main>
@endsection
