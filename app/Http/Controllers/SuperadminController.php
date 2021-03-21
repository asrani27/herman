<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Skpd;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\KategoriUpload;
use Illuminate\Support\Facades\Auth;

class SuperadminController extends Controller
{
    public function home()
    {
        return view('superadmin.home');
    }

    public function createuser($id)
    {
        $data = Pegawai::find($id);
        $role = Role::where('name','pegawai')->first();

        $attr['name'] = $data->nama; 
        $attr['username'] = $data->nip;
        $attr['password'] = bcrypt('pnskapuas');
        
        $cek = User::where('username', $data->nip)->first();
        if($cek == null){
            $n = User::create($attr);
            $data->update([
                'user_id' => $n->id,
            ]);
            $n->roles()->attach($role);
            toastr()->success('Username '.$data->nip.'<br />Password : pnskapuas');
        }else{
            toastr()->error('Username Sudah Ada');
        }
        return back();
    }

    public function resetpass($id)
    {
        Pegawai::find($id)->user->update([
            'password' => bcrypt('pnskapuas')
        ]);
        toastr()->success('Password : pnskapuas');
        return back();
    }
    
    public function profil()
    {
        return view('superadmin.profil');
    }
    public function changeSuperadmin(Request $req)
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

    public function skpd()
    {
        $data = Skpd::get();
        return view('superadmin.skpd.index',compact('data'));
    }

    public function addSkpd()
    {
        return view('superadmin.skpd.create');
    }
    
    public function storeSkpd(Request $req)
    {
        Skpd::create($req->all());
        toastr()->success('SKPD Berhasil Di simpan');
        return redirect('/superadmin/skpd');
    }
    
    public function editSkpd($id)
    {
        $data = Skpd::find($id);
        return view('superadmin.skpd.edit',compact('data'));
    }
    
    public function updateSkpd(Request $req, $id)
    {
        Skpd::find($id)->update($req->all());
        toastr()->success('SKPD Berhasil Di Update');
        return redirect('/superadmin/skpd');
    }

    public function deleteSkpd($id)
    {
        try{
            Skpd::find($id)->delete();
            toastr()->success('SKPD Berhasil Di Hapus');
            return back();
        }catch(\Exception $e){
            toastr()->error('SKPD Gagal Di Hapus Karena Terkait Dengan Data Lain');
            return back();
        }
    }

    public function pegawai()
    {
        $data = Pegawai::paginate(10);
        return view('superadmin.pegawai.index',compact('data'));
    }

    public function addPegawai()
    {
        return view('superadmin.pegawai.create');
    }
    
    public function storePegawai(Request $req)
    {
        $messages = [
            'numeric' => 'Inputan Harus Angka',
            'min'     => 'Harus 18 Digit',
            'unique'  => 'NIP sudah Ada',
        ];

        $rules = [
            'nip' =>  'unique:pegawai|min:18|numeric',
            'nama' => 'required'
        ];
        $req->validate($rules, $messages);
        
        $req->flash();

        Pegawai::create($req->all());
        toastr()->success('Pegawai Berhasil Di simpan');
        return redirect('/superadmin/pegawai');
    }
    
    public function editPegawai($id)
    {
        $data = Pegawai::find($id);
        return view('superadmin.pegawai.edit',compact('data'));
    }
    
    public function updatePegawai(Request $req, $id)
    {
        $messages = [
            'numeric' => 'Inputan Harus Angka',
            'min'     => 'Harus 18 Digit',
            'unique'  => 'NIP sudah Ada',
        ];

        $rules = [
            'nip' =>  '|min:18|numeric|unique:pegawai,nip,'.$id,
            'nama' => 'required'
        ];
        $req->validate($rules, $messages);
        
        $req->flash();
        Pegawai::find($id)->update($req->all());
        toastr()->success('Pegawai Berhasil Di Update');
        return redirect('/superadmin/pegawai');
    }

    public function deletePegawai($id)
    {
        try{
            Pegawai::find($id)->delete();
            toastr()->success('pegawai Berhasil Di Hapus');
            return back();
        }catch(\Exception $e){
            toastr()->error('pegawai Gagal Di Hapus Karena Terkait Dengan Data Lain');
            return back();
        }
    }
    
    public function kategori()
    {
        $data = KategoriUpload::paginate(10);
        return view('superadmin.kategori.index',compact('data'));
    }

    public function addKategori()
    {
        return view('superadmin.kategori.create');
    }
    
    public function storeKategori(Request $req)
    {
        KategoriUpload::create($req->all());
        toastr()->success('Kategori Berhasil Di simpan');
        return redirect('/superadmin/setting/kategori/upload');
    }
    
    public function editKategori($id)
    {
        $data = KategoriUpload::find($id);
        return view('superadmin.kategori.edit',compact('data'));
    }
    
    public function updateKategori(Request $req, $id)
    {
        KategoriUpload::find($id)->update($req->all());
        toastr()->success('Kategori Berhasil Di Update');
        return redirect('/superadmin/setting/kategori/upload');
    }

    public function deleteKategori($id)
    {
        try{
            KategoriUpload::find($id)->delete();
            toastr()->success('Kategori Berhasil Di Hapus');
            return back();
        }catch(\Exception $e){
            toastr()->error('Kategori Gagal Di Hapus Karena Terkait Dengan Data Lain');
            return back();
        }
    }
}
