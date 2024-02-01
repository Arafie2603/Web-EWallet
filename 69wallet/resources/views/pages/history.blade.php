@extends('layouts.base')

@section('content')
<div class="card-body">
    <div class="card-body">
        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
            <div class="d-flex align-items-center">
                <h5 class="text-decoration-none card-title text-dark font-weight-bold mr-auto">Riwayat
                    Transaksi</h5>
                <div class="mb-3">
                    <a href="{{ url('cetak_riwayat') }}">Cetak</a>
                    <a href="{{ url('filter') }}" class="btn btn-primary">Ascending</a>
                    <a href="{{ url('history') }}" class="btn btn-primary">Descending</a>
                </div>
            </div>
            <th>Foto produk</th>
            <th>Nama produk</th>
            <th>Tanggal pembayaran</th>
            <th>Nomor Telepon</th>
            <th>Pengeluaran</th>
            <th>Poin</th>
            <th>Status</th>
            <th>Detail</th>
            <tbody>
                @foreach ($transaAll as $index => $td)
                    <tr>
                        <td><img src="{{ asset('storage/storage/' . $td->foto_produk) }}" class="img-thumbnail"
                                width="100" height="100" alt=""></td>
                        <td>{{ $td->nama_produk }}</td>
                        <td>{{ $date[$index] }}</td>
                        <td>{{ $td->noTelp }}</td>
                        @if ($td->total_harga >= 3000)
                        <td>-Rp{{ number_format($td->total_harga, 0, ',', '.') }}</td>
                        @else
                        <td>-{{ $td->total_harga }}</td> 
                        @endif
                        <td>+{{ $td->reward_poin }}</td>
                        <td>{{ $td->status }}</td>
                        <td> <a href="{{ url('detail_receipt') }}/{{ $td->id_transaksi_detail }}"
                                class="btn-block">receipt</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <div class="dataTables_paginate paging_simple_numbers">
                {{ $transaAll->links() }}
            </div>
        </div>
        <table class="table table-borderless" id="dataTable" width="50%" cellspacing="0">
            <div class="d-flex align-items-center">
                <h5 class="text-decoration-none card-title text-dark font-weight-bold mr-auto">Riwayat
                    Poin</h5>
            </div>
            <th class="text-center">No</th>
            <th>Nama produk</th>
            <th>Tanggal Reedem</th>
            <th>Poin</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <tbody>
                @foreach ($redtail as $index => $rt)
                    <tr>
                        <td class="text-center">
                            {{ ($redtail->currentPage() - 1) * $redtail->perPage() + $loop->iteration }}
                        </td>
                        <td>{{ $rt->nama_reward }}</td>
                        <td>{{ $date_poin[$index] }}</td>
                        <td>-{{ $rt->harga_poin }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <div class="dataTables_paginate paging_simple_numbers">
                {{ $redtail->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
