<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use \App\Models\Produk;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;

class KategoriProduk extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        $produk = Produk::all();
        return view('pages.kategori_produk', compact('kategori', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function halreward()
    {
        $user = User::where('id', '=', Auth::user()->id)->firstOrFail(); 
        $produk = Produk::all();  
        // dd($produk); 
        return view('pages.rewards', compact('user', 'produk'));
    }

    public function reedem(Request $request)
    {

        // dd($request->reedem);
        $akun = User::with('akun')->find(Auth::user()->id);
        $poinUser = $akun->akun->poin;
        if ($poinUser < $request->reedem) {
            return redirect()->back()->with('error', 'Maaf saldo anda tidak mencukupi, silahkan isi terlebih dahulu');
        } 
        $result_reedem = $poinUser - $request->reedem;
        $akun->akun->poin = $result_reedem;
        $akun->akun->save();
        return back()->with('success', 'Anda berhasil melakukan reedem');
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
        $kategori_id = $id;

        $produk = Produk::where('kategori_id', $id)->get();
        $kategori = Kategori::where('id_kategori', $id)->firstorfail();
        // @dd($transaksidetail->p);
        $data_kategori = Kategori::all();
        $user = User::with('akun')->find(Auth::user()->id);
        // $tranDetail = TransaksiDetail::with('produk')->where('produk_id', $request->id_produk)->first();
        $kategoriPro = Kategori::with('produk')->where('kategori_id', $kategori_id);


        return view('pages.produk', compact('kategori', 'produk', 'data_kategori', 'kategoriPro'));
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
