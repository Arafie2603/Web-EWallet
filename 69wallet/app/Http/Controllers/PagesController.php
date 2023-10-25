<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');   
    }



}
