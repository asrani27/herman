<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prov extends Model
{
    use HasFactory;

    protected $table ='prov';
    public $timestamps = false;

    public function kota()
    {
        return $this->hasMany(kota::class, 'prov_id','id');
    }
}
