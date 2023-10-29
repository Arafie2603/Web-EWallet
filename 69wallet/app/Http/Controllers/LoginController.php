<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
                    'role_id' => $session->role_id,
                    'id_user' => $session->id
                ]);
                if ($session->role_id == 1) {
                    return redirect()->intended('admin/dashboard')->with('success', "Selamat Datang " . $session->name);
                } else if ($session->role_id == 0) {
                    $user = User::with('akun')->find(Auth::user()->id);
                    $transa = new Transaksi();
                    return redirect('/dashboard_user')->with(compact('user', 'transa'));
                }
            } else {
                return Redirect::to('/')->with('message', 'email atau password salah');
            }
        } catch (\Throwable $th) {
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
            User::where('id', session()->get('id'))->update([
                'name'  =>  $request->name,
                'email' => $request->email,
            ]);
            $user = User::find(session('id'));
            // $id = session()->get('id');

            $result = User::where('id', session()->get('id'))->first();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/storage', $imageName);
                $user->image = 'storage/' . $imageName;
            }

            $user->save();

            session([
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->image,
            ]);

            session()->forget('name');
            session()->forget('email');
            session()->forget('image');
            session([
                'name'  =>  $result->name,
                'email' =>  $result->email,
                'image' => time() . '.' . $request->image->extension(),
            ]);




            return redirect()->back()->with('success', 'data berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'data gagal diupdate');
        }
    }



    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
