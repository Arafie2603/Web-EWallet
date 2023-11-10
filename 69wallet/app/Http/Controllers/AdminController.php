<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Produk;
use App\Models\Reward;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Akun::count();
        $produk = Produk::count();
        $reward = Reward::count();
        session([
            'jumlah_user' => $users,
            'jumlah_produk' =>$produk,
            'jumlah_reward' => $reward
        ]);


        
        return view('admin.dashboard');
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
    public function store(Request $request, string $id)
    {
        
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
