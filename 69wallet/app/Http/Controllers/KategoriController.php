<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $kategori = Kategori::paginate(5);
        $user = User::where('id', '=', Auth::user()->id)->firstOrFail();

        return view('admin.kategori', compact('kategori', 'user'));
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

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        if ($request->hasFile('foto_kategori')) {
            $image = $request->file('foto_kategori');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/storage', $imageName);
            $kategori->foto_kategori = '/' . $imageName;
        }
        $kategori->save();



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
        $kategori = Kategori::findorfail($id);
        if($request->hasFile('foto_kategori')){
            $image = $request->file('foto_kategori');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/storage', $imageName);
            $kategori->foto_kategori = '/' . $imageName;
        }
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return back()->with('success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::where('id_kategori','=',$id)->firstOrFail();
        $kategori->delete();
        return back()->with('info', 'Data berhasil dihapus');
    }
}
