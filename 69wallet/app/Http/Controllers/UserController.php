<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use \App\Models\Akun;
use App\Models\RewardDetail;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $user = User::with('akun')->find(Auth::user()->id);
            if ($user->role_id == 1) {
                $user = User::where('id', '=', Auth::user()->id)->firstOrFail();
                $lastUser = User::latest()->first();
                $lastId = $lastUser->id;
                $data_user = User::with('akun')->paginate(5);
                return view('admin.user', compact('user', 'data_user', 'lastId'));
                // return redirect()->route('user.index', compact('user', 'data_user', 'lastId'));
            }

            $transa = DB::table('transaksi_details')
                ->select('*')
                ->join('produks', 'produks.id_produk', '=', 'transaksi_details.produk_id')
                ->join('transaksis', 'transaksis.id_transaksi', '=', 'transaksi_details.transaksi_id')
                ->where('akun_id', '=', $user->akun->id_akun)
                ->orderBy('transaksi_details.created_at', 'desc')
                ->paginate(3);

            $redtail = DB::table('reward_details')
                ->select('*')
                ->join('akuns', 'akuns.id_akun', '=', 'reward_details.akun_id')
                ->join('rewards', 'rewards.id_reward', '=', 'reward_details.reward_id')
                ->where('akun_id', '=', $user->akun->id_akun)
                ->where('reward_details.status', '=', 'tidak terpakai')
                ->paginate(3);

            $finalPoin = array();
            $date = [];

            $get_poin = $request->session()->get('poin');
            foreach ($transa as $tr) {
                $created_at = $tr->created_at;
                $get_poin;
                $formated = substr($created_at, 5, -12);
                $formated = date("F", mktime(0, 0, 0, $formated, 10));

                // GET year and date
                $formattedDate = substr($created_at, 8, -9);

                // GET year
                $formatedYear = substr($created_at, 0, -15);

                $date2 = ($formated . ',' . $formattedDate . ' ' . $formatedYear);
                array_push($date, $date2);
                array_push($finalPoin, $get_poin);
            }
        } catch (\Throwable $th) {
            $finalPoin = '';
            $date = '';
            $poin = 0;
        }
        // dd($finalPoin);
        // dd($date);
        // $user->akun->poin += $poin;
        $user->akun->save();

        return view('pages.dashboard', compact('user', 'transa', 'finalPoin', 'date', 'redtail'));
    }

    // History Page

    public function history()
    {
        $user = User::with('akun')->find(Auth::user()->id);
        $transaAll = DB::table('transaksi_details')
            ->select('*')
            ->join('produks', 'produks.id_produk', '=', 'transaksi_details.produk_id')
            ->join('transaksis', 'transaksis.id_transaksi', '=', 'transaksi_details.transaksi_id')
            ->where('akun_id', '=', $user->akun->id_akun)
            ->orderBy('transaksi_details.created_at', 'desc')
            ->paginate(5);


        $redtail = DB::table('reward_details')
            ->select('*')
            ->join('akuns', 'akuns.id_akun', 'reward_details.akun_id')
            ->join('rewards', 'rewards.id_reward', '=', 'reward_details.reward_id')
            ->where('akun_id', '=', $user->akun->id_akun)
            ->orderBy('reward_details.created_at', 'desc')
            ->paginate(3);
        // dd($redtail->harga_poin);

        $rewardDetail = RewardDetail::select('*')
            ->where('akun_id', '=', $user->akun->id_akun)
            ->get();
        try {

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
            foreach ($rewardDetail as $rt) {
                $created_at_poin = $rt->created_at;
                $formated_poin = substr($created_at_poin, 5, -12);
                $formated_poin = date("F", mktime(0, 0, 0, $formated_poin, 10));
                // GET year and date
                $formattedDate_poin = substr($created_at_poin, 8, -9);
                // GET year
                $formatedYear_poin = substr($created_at_poin, 0, -15);
                $datePoin = ($formated_poin . ',' . $formattedDate_poin . ' ' . $formatedYear_poin);
                array_push($date_poin, $datePoin);
            }
        } catch (\Throwable $th) {
            $finalPoin = '';
            $date = '';
            $poin = 0;
            $date_poin = '';
        }
        return view('pages.history', compact('transaAll', 'user', 'finalPoin', 'date', 'redtail', 'date_poin'));
    }

    public function topup(Request $request)
    {
        $user = User::with('akun')->find(Auth::user()->id_akun);
        $user = Auth::user();

        if (Hash::check($request->password, $user->password)) {
            $user->akun->id_akun = $user->akun->id_akun;
            $user->akun->user_id = $user->akun->user_id;
            $user->akun->no_telp = $user->akun->no_telp;
            $user->akun->saldo += $request->saldo;
            $user->akun->pengeluaran = $user->akun->pengeluaran;
            $user->akun->save();
            return back()->with('success', 'Top up saldo berhasil dilakukan');
        } else {
            return back()->with('error', 'Top up saldo gagal dilakukan');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate(
            [
                // 'password' => 'required',
                // 'password_ulang' => 'same:password',
                'password' => 'required|confirmed'
            ]
        );

        try {
            $data_user = User::where('id', '=', $request->id)->first();
            if ($data_user) {
                return back()->with('info', 'Duplikat data (Data Pegawai sudah terdaftar di dalam sistem)');
            }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save(); // Simpan pengguna baru

            // Buat entitas Akun yang terkait dengan pengguna
            $akun = new Akun();
            $akun->user_id = $request->id;
            $akun->saldo = $request->saldo;
            $akun->poin = $request->poin;
            $akun->no_telp = $request->no_telp;
            $akun->pengeluaran = 0;

            $user->akun()->save($akun);
            $user->save();
            return back()->with('success', 'Data Berhasil ditambah');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Data Berhasil ditambah');
        }
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
        request()->validate([
            'password_confirmation' => 'same:password_baru',
        ]);

        $user = User::findorfail($id);
        $user->id = $request->id;
        $user->name = $request->name;
        $user->email = $request->email;

        try {
            $akun = Akun::select('*')
            ->where('user_id', '=', $id)
            ->get();
            $currentPoin = $akun[0]->poin;
            // dd($currentPoin);
    
            $akun[0]->poin = $request->poin;
            if($akun[0]->poin == null) {
                $akun[0]->poin = $currentPoin;
            }
            $akun[0]->saldo = $request->saldo;
            $akun[0]->save();
    
            if ($request->password_baru) {
                $user->password = bcrypt($request->password_baru);
            }

            $user->save();
            return back()->with('success', 'Data berhasil diubah!');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'Data gagal diubah!, pastikan semua inputan diisi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();
        $user->delete();
        return back()->with('info', 'Data berhasil dihapus');
    }
}
