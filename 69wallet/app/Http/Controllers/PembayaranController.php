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
use Barryvdh\DomPDF\Facade\Pdf as PDFa;

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

        $discount = 0;
        // menyimpan value saldo dan harga
        $saldoUser = $user->akun->saldo;
        $hargaProduk = $request->harga;
        $saldoBaruUser = 0;
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

        if ($request->payment == 'saldo' && $request->id_reward == null) {
            $saldoBaruUser = $saldoUser - $hargaProduk;
            $harga = $hargaProduk;
            $user->akun->saldo = $saldoBaruUser;
            if ($harga >= 5000 && $harga < 10000) {
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
                $poinUser += $poin;
            } else if ($harga >= 25000 && $harga < 30000) {
                $poin = 5;
                $poinUser += $poin;
            }
            $request->session()->put('poin', $poin);
            $user->akun->poin = $poinUser;
        } else if ($request->payment == 'poin') {

            $poinBaru = $poinUser - $poinProduk;
            $harga = $request->poin;
            $user->akun->poin = $poinBaru;
        }
        $result = $request->id_reward;
        $reward = DB::table('reward_details')
            ->select('*')
            ->join('rewards', 'rewards.id_reward', '=', 'reward_details.reward_id')
            ->join('akuns', 'akuns.id_akun', '=', 'reward_details.akun_id')
            ->where('id_reward_detail', '=', $request->id_reward)
            ->where('status', '=', 'tidak terpakai')
            ->get('reward_details.*');
        try {
            if ($result == true) {
                // dd($request->id_reward);

                // dd($reward);
                $discount = intval($reward[0]->nilai_reward * $hargaProduk);
                $harga = $hargaProduk - $discount;
                $saldoBaruUser = $saldoUser - $hargaProduk;
                $user->akun->saldo = $saldoBaruUser;
                session([
                    'total_harga' => $harga
                ]);
                DB::table('reward_details')->where('id_reward_detail', '=', $result)->update(array('status' => 'terpakai'));
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Anda mencoba refresh web, silahkan melakukan pembayaran ulang terlebih dahulu');
        }

        $user->akun->save();
        // Transaksi
        try {
            $transaksi->akun_id = $user->akun->user_id;
            $transaksi->id_transaksi = date('Y') . str_pad($jumlah + 1, 3, '0', STR_PAD_LEFT);
            $transaksi->total_harga = $harga;
            if($request->id_kategori == 2) {
                $transaksi->noTelp = $request->phone;
            }else {
                $transaksi->noTelp = 0;

            }
            $transaksi->total_item = 1;
            $transaksi->status = 'berhasil';
            $transaksi->akuns()->associate($user->akun)->save();
            $user->akun->save();

            //Transak siDetail
            $transaksiDetail->transaksi_id =  $transaksi->id_transaksi;
            $transaksiDetail->produk_id = $request->id_produk;
            $transaksiDetail->harga_satuan = $hargaProduk;
            $transaksiDetail->reward_poin = $poin;
            $transaksiDetail->jumlah = 1;
            $transaksiDetail->save();
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Sepertinya ada kesalahan dalam sistem, sebaiknya lakukan ulang transaksi');
        }
        // Join antara transa detial dengan produk berdasarkan id user yang melakukan transaksi
        $tranDetail = TransaksiDetail::with('produk')->where('produk_id', $request->id_produk)->first();
        return view('pages.receipt', compact('data', 'transaksi', 'transaksiDetail', 'tranDetail', 'poin', 'result', 'discount', 'reward'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detail(Request $request, string $id)
    {
        $jumlah = Transaksi::count();
        $user = User::with('akun')->find(Auth::user()->id);
        $transaksiDetail = DB::table('transaksi_details')
            ->select('*')
            ->join('produks', 'produks.id_produk', '=', 'transaksi_details.produk_id')
            ->join('transaksis', 'transaksis.id_transaksi', '=', 'transaksi_details.transaksi_id')
            ->where('id_transaksi_detail', '=', $id)
            ->get('transaksi_details.*');
        // dd($transaksiDetail);

        $selisih = $transaksiDetail[0]->harga - $transaksiDetail[0]->total_harga;
        
        $produk = new Produk();

        return view('pages.detail_receipt', compact('jumlah', 'user', 'transaksiDetail', 'produk', 'selisih'));
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
