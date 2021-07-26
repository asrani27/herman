<?php

namespace App\Http\Controllers;

use App\Models\prov;
use Illuminate\Http\Request;

class ContohController extends Controller
{
    public function index()
    {
        $data = prov::get()->map(function($item){
            $item->kota->map(function($item2){
                if(count($item2->kecamatan) == 0){
                    $item2->merge_kota = 1;
                }else{
                    $item2->merge_kota = count($item2->kecamatan);
                }
                return count($item2->kecamatan);
            });
            $item->merge_prov = $item->kota->sum('merge_kota');
            return $item;
        });
        
        return view('contoh',compact('data'));
    }
}
