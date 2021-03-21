<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function home()
    {
        return view('pegawai.home');
    }
}
