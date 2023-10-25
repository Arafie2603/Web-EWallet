<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Kategori;
use \App\Models\Produk;
use \App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProdukUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $kategori = Kategori::all();
        $produk = Produk::paginate(5);
        $user = User::where('id', '=', Auth::user()->id)->firstOrFail();
        $lastId = Produk::latest()->value('id_produk');

        
        return view('pages.produk', compact('kategori', 'produk', 'user', 'lastId'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
