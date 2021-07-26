<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    use HasFactory;
    protected $table ='kecamatan';
    public $timestamps = false;
    public function kelurahan()
    {
        return $this->hasMany(kelurahan::class, 'kelurahan_id','id');
    }
}
