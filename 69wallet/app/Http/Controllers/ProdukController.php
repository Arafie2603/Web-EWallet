<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use \App\Models\Kategori;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        $produk = Produk::paginate(5);
        $user = User::where('id', '=', Auth::user()->id)->firstOrFail();
        $lastId = Produk::latest()->value('id_produk');

        return view('admin.produk', compact('kategori', 'produk', 'user', 'lastId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function bayar(Request $request, string $id)
    {
        $user = User::with('akun')->find(Auth::user()->id);
        $kategori = DB::table('kategoris')
        ->where('id_kategori', $id)
        ->get();
        $produk =  Produk::where('id_produk', $id)->first();
        $redtail = DB::table('reward_details')
        ->select('*')
        ->join('akuns', 'akuns.id_akun', '=', 'reward_details.akun_id')
        ->join('rewards', 'rewards.id_reward', '=', 'reward_details.reward_id')
        ->where('akun_id', '=', $user->akun->id_akun)
        ->get('reward_details.*');
        $prokat = Produk::with('kategori')->where('kategori_id', $produk->id_produk)->first();
        return view('pages.pembayaran', compact('produk', 'prokat', 'user', 'redtail', 'kategori'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $produk = new Produk();
            $jumlah = Produk::count();
            // dd($jumlah);
            $produk->kategori_id = $request->kategori_id;
            $produk->nama_produk = $request->nama_produk;
            $produk->kode_produk= "PR".str_pad($jumlah+1, 5, '0', STR_PAD_LEFT);
            // dd($produk->kode_produk);
            $produk->harga = $request->harga;
            $produk->poin = $request->poin;
            $produk->status = $request->status;
    
            if ($request->hasFile('foto_produk')) {
                $image = $request->file('foto_produk');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/storage', $imageName);
                $produk->foto_produk = '/' . $imageName;
            }
    
            $produk->save();
        } catch (\Throwable $th) {
            $produk->kode_produk= "PR".str_pad($jumlah+1, 5, '0', STR_PAD_LEFT);
            return back()->with('error', 'Data gagal ditambahkan');
        }
        return back()->with('success', 'Data berhasil ditambah');

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
        $produk = Produk::findorfail($id);
        $produk->nama_produk = $request->nama_produk;
        if ($request->hasFile('foto_produk')) {
            $image = $request->file('foto_produk');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/storage', $imageName);
            $produk->foto_produk = '/' . $imageName;
        }
        $produk->poin = $request->poin;
        $produk->harga = $request->harga;
        $produk->status = $request->status;
        $produk->save();  
        
        return back()->with('warning', 'Data berhasil diubah');      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::where('id_produk','=',$id)->firstOrFail();
        $produk->delete();
        return back()->with('error', 'Data berhasil dihapus');
    }
}
