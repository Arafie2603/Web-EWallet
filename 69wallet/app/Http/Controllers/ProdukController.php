<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use \App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use \App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

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
        // produk = Produk::where('kategori_id', $id )->get();
        // $kategori = Kategori::where('id_kategori', $id)->firstorfail();
        // // @dd($transaksidetail->p);
        // $data_kategori = Kategori::all();
        $user = User::with('akun')->find(Auth::user()->id);
        $produk =  Produk::where('id_produk', $id)->first();
        // $tranDetail = TransaksiDetail::with('produk')->where('produk_id', $request->id_produk)->first();
        $prokat = Produk::with('kategori')->where('kategori_id', $produk->id_produk)->first();
        return view('pages.pembayaran', compact('produk', 'prokat', 'user'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produk = new Produk();
        $jumlah = Produk::count();
        $produk->kategori_id = $request->kategori_id;
        $produk->nama_produk = $request->nama_produk;
        $produk->kode_produk= "PR".str_pad($jumlah+1, 5, '0', STR_PAD_LEFT);
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
        //
    }
}
