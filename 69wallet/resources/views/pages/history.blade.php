@extends('layouts.base')
@section('content')
<div class="card-body">
    {{-- ===== AWALAN FORM ===== --}}

    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">

        <div class="card-body">
            <tbody>
                @foreach ($transaAll as $index => $td)
                    <tr>
                        <td><img src="{{ asset('storage/storage/' . $td->foto_produk) }}"
                                class="img-thumbnail" width="100" height="100" alt=""></td>
                        <td>{{ $td->nama_produk }}</td>
                        <td>{{ $formattedDate }}</td>
                        <td>{{ $user->akun->no_telp }}</td>
                        <td>-Rp{{ number_format($td->harga, 0, ',', '.') }}</td>
                        <td>+{{ $finalPoin[$index] }}</td>

                        <td>{{ $td->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </div>
    </table>
    {{-- <div class="dataTables_paginate paging_simple_numbers">
        {{ $transa->links() }}
    </div> --}}
</div>
@endsection