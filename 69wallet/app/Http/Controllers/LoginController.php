<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function login(Request $request)
    {
        try {
            $ceklogin = $request->only('email', 'password');
        if (Auth::attempt($ceklogin)) {
            $session = User::all()->where('email', $request->email)->first();
            session([
                'berhasil_login' => true,
                'name' => $session->name,
                'email' => $session->email,
                'image' => $session->image,
                'role_id' => $session->role_id,
                'id_user' => $session->id
            ]);

            if ($session->role_id == 1) {
                return redirect()->intended('admin/dashboard');
            } else {
                $user = User::with('akun')->find(Auth::user()->id);
                $transa = new Transaksi();
                return redirect('/dashboard_user')->with(compact('user', 'transa'));
            }
        } else {
            return redirect()->to('/')->with('error', 'Email atau password salah');
        }
        } catch (\Throwable $th) {
            return back()->with('error', 'Ada kesalahan dalam prograM');
        }
    }


    public function update_profile(Request $request)
    {
        $request->validate([
            'name'  =>  'required|max:255',
            'email' => 'required|email|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'name.required' =>  'Nama harus diisi',
            'name.max' =>  'karakter Nama terlalu panjang',
            'email.required' =>  'email harus diisi',
            'email.email'   =>  'email tidak valid',
            'email.max' =>  'karakter email terlalu panjang',

        ]);


        try {

            $user = User::select('*')
                ->where('id', '=', Auth::user()->id)
                ->get();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/storage', $imageName);
                $user[0]->image = '/' . $imageName;
            }
            $user[0]->name = $request->name;
            $user[0]->email = $request->email;
            $user[0]->save();    
            session([
                'image' => $user[0]->image,
                'name' => $user[0]->name,
                'email' => $user[0]->email
            ]);
            return redirect()->back()->with('success', 'data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'data gagal ditambahkan');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
