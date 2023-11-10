<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class RewardsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reward = Reward::paginate(5);
        return view('admin.rewards', compact('reward'));
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
        $reward = new Reward();
        $jumlah = Reward::count();
        $reward->id_reward = date('d') . str_pad($jumlah + 1, 2, '0', STR_PAD_LEFT);
        $reward->nama_reward = $request->nama_reward;
        $reward->harga_poin = $request->harga_poin;
        $reward->nilai_reward = $request->nilai_reward;

        $reward->save();

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
        $reward = Reward::findorfail($id);
        $reward->nama_reward = $request->nama_reward;

        $reward->harga_poin = $request->harga_poin;
        $reward->nilai_reward = $request->nilai_reward;

        $reward->save();  
        return back()->with('warning', 'Data berhasil diubah');      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reward = Reward::where('id_reward','=',$id)->firstOrFail();
        $reward->delete();
        return back()->with('error', 'Data berhasil dihapus');
    }
}
