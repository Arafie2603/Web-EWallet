<?php

namespace App\Http\Controllers;

use App\Jobs\ProsesDataBertahap;
use Barryvdh\DomPDF\Facade\Pdf as PDFa;
use App\Models\RewardDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('akun')->find(Auth::user()->id);
        $transaAll = DB::table('transaksi_details')
        ->select('*')
        ->join('produks', 'produks.id_produk', '=', 'transaksi_details.produk_id')
        ->join('transaksis', 'transaksis.id_transaksi', '=', 'transaksi_details.transaksi_id')
        ->where('akun_id', '=', $user->akun->id_akun)
        ->orderBy('transaksi_details.created_at', 'asc')
        ->get();

        $finalPoin = [];
        $date = [];
        $date_poin = [];
        foreach ($transaAll as $tr) {
            $created_at = $tr->created_at;
            $poin = 0;
            $harga = $tr->harga_satuan;
            $formated = substr($created_at, 5, -12);
            $formated = date("F", mktime(0, 0, 0, $formated, 10));
            // GET year and date
            $formattedDate = substr($created_at, 8, -9);
            // GET year
            $formatedYear = substr($created_at, 0, -15);

            $date2 = ($formated . ',' . $formattedDate . ' ' . $formatedYear);
            array_push($finalPoin, $poin);
            array_push($date, $date2);
        }
        
        $pdf = PDFa::loadview('pages.riwayat_pembayaran', compact('transaAll', 'date'));

        return $pdf->stream('contoh.pdf');
        return view('pages.riwayat_pembayaran', compact('transaAll', 'user', 'finalPoin', 'date', 'redtail', 'date_poin'));
    }

    public function test() {
        return view('pages.template');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function CetakRiwayat(Request $request) {
        $pdf = PDFa::loadview('pages.riwayat_pembayaran');

        return $pdf->stream('contoh.pdf');
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
