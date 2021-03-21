<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    public function home()
    {
        return view('pegawai.home');
    }
    public function profil()
    {
        return view('pegawai.profil');
    }
    
    public function changePegawai(Request $req)
    {
        if($req->password != $req->password2){
            toastr()->error('Password Tidak Sama');
        }else{
            $p = Auth::user();
            $p->password = bcrypt($req->password);
            $p->save();
            toastr()->success('Password Berhasil Di Ubah');
        }
        return back();
    }

    public function upload()
    {
        return view('pegawai.upload.index');
    }
    
    public function addUpload()
    {
        return view('pegawai.upload.create');
    }
}
