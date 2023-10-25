<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
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
        $request->validate([
            'name' => 'required|max:255|unique:users,name',
            'email' => 'required|email|max:255',
            'password' => 'required'
        ], [
            'name.required' => 'nama harus diisi',
            'name.max' => 'karakter nama terlalu panjang',
            'name.unique' => 'nama sudah ada',

            'email.required' => 'email harus diisi',
            'email.email' => 'email tidak valid',
            'email.max' => 'karakter email terlalu panjang',
            'password.required' => 'password harus diisi'
        ]);
    

        $password = Hash::make($request->password);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->role_id = 0;
        $user->image = 'default.png';

        $user->save();

        $akun = new Akun();
        $akun->user_id = $user->id;
        $akun->no_telp = "0000";
        $akun->poin = 0;
        $akun->saldo = 0;
        $akun->pengeluaran = 0;
        $akun->save();  

        try {
            return redirect()->to('/')->with('success', 'data berhasil ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'data gagal ditambahkan');
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
