<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function receipt()
    {
        return view('pages.receipt');
    }

    public function pembayaran(Request $request)
    {

        $jumlah = Transaksi::count();
        $user = User::with('akun')->find(Auth::user()->id);
        $transaksi = new Transaksi();
        $transaksiDetail = new TransaksiDetail();
        $produk = new Produk();

        // Join antara tabel akun dan transaksi sesuai dengan akun (user login)
        $akun = Akun::with('transaksis')->find($transaksi->akun_id);
        // $transaksi = Transaksi::with('transaksidetail')->find(Auth::user()->id);
        $data = Carbon::now('Asia/Jakarta');

        if ($request->payment == null) {
            return redirect()->back()->with('warning', 'silahkan pilih metode pembayaran terlebih dahulu');
        }


        // menyimpan value saldo dan harga
        $saldoUser = $user->akun->saldo;
        $hargaProduk = $request->harga;
        $harga = 0;

        // menyimpan value poin dan harga (poin)
        $poinUser = $user->akun->poin;
        $poinProduk = $request->poin;
        $poin = 0;
        $final_poin = array();

        if ($request->payment == 'saldo' && $hargaProduk > $saldoUser) {
            return redirect()->back()->with('error', 'Maaf saldo anda tidak mencukupi, silahkan isi terlebih dahulu');
        } else if ($request->payment == 'poin' && $poinProduk > $poinUser) {
            return redirect()->back()->with('error', 'Maaf poin anda tidak mencukupi');
        }


        if ($request->payment == 'saldo') {

            $saldoBaruUser = $saldoUser - $hargaProduk;
            $harga = $hargaProduk;
            $user->akun->saldo = $saldoBaruUser;
            if ($harga >= 5000 && $harga < 10000) {
                array_push($final_poin, $poin);
                $poin = 1;
                $poinUser += $poin;
            } else if ($harga >= 10000 && $harga < 15000) {
                $poin = 2;
                $poinUser += $poin;
            } else if ($harga >= 15000 && $harga < 20000) {
                $poin = 3;
                $poinUser += $poin;
            } else if ($harga >= 20000 && $harga < 25000) {
                $poin = 4;
                array_push($final_poin, $poin);
                $poinUser += $poin;
            }
            $request->session()->put('poin', $poin);
            $user->akun->poin = $poinUser;
            $user->akun->save();
            
    
        } else if ($request->payment == 'poin') {

            $poinBaru = $poinUser - $poinProduk;
            $harga = $request->poin;
            $user->akun->poin = $poinBaru;
        }


        // Transaksi
        $transaksi->akun_id = $user->akun->user_id;
        $transaksi->id_transaksi = date('Y') . str_pad($jumlah + 1, 3, '0', STR_PAD_LEFT);
        $transaksi->total_harga = $harga;
        $transaksi->total_item = 1;
        $transaksi->status = 'berhasil';
        $transaksi->akuns()->associate($user->akun)->save();
        $user->akun->save();

        //Transak siDetail
        $transaksiDetail->transaksi_id =  $transaksi->id_transaksi;
        $transaksiDetail->produk_id = $request->id_produk;
        $transaksiDetail->harga_satuan = $harga;
        $transaksiDetail->reward_poin = $poin;
        $transaksiDetail->jumlah = 1;
        $transaksiDetail->save();

        // Join antara transa detial dengan produk berdasarkan id user yang melakukan transaksi
        $tranDetail = TransaksiDetail::with('produk')->where('produk_id', $request->id_produk)->first();




        return view('pages.receipt', compact('data', 'transaksi', 'transaksiDetail', 'tranDetail', 'poin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detail(Request $request, string $id) 
    {
        // $kategori_id = $id;

        // $produk = Produk::where('kategori_id', $id)->get();
        // $kategori = Kategori::where('id_kategori', $id)->firstorfail();
        // // @dd($transaksidetail->p);
        // $data_kategori = Kategori::all();
        // $user = User::with('akun')->find(Auth::user()->id);
        // // $tranDetail = TransaksiDetail::with('produk')->where('produk_id', $request->id_produk)->first();
        // $kategoriPro = Kategori::with('produk')->where('kategori_id', $kategori_id);
        
        $jumlah = Transaksi::count();
        $user = User::with('akun')->find(Auth::user()->id);
        $transaksiDetail = DB::table('transaksi_details')
                        ->select('*')
                        ->join('produks', 'produks.id_produk', '=', 'transaksi_details.produk_id')
                        ->join('transaksis', 'transaksis.id_transaksi', '=', 'transaksi_details.transaksi_id')
                        ->where('id_transaksi_detail', '=', $id)
                        ->get('transaksi_details.*');
        // dd($transaksiDetail);
        $produk = new Produk();

        return view('pages.detail_receipt', compact('jumlah', 'user', 'transaksiDetail', 'produk'));
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
