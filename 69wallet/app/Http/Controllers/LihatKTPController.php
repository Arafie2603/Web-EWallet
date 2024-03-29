<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LihatKTPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $user = DB::table('users')->where('id', $id)->first();

        return view('pages.lihat-ktp', compact('user'));
        
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
        DB::table('users')
        ->where('id', $id)
        ->update(['status' => 'verifikasi']);
        
        return back()->with('succress', 'Data berhasil diubah');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
