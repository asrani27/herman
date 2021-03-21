<?php

use App\Models\Skpd;
use App\Models\Pegawai;

function countSkpd()
{
    return Skpd::get()->count();
}

function countPegawai()
{
    return Pegawai::get()->count();
}

function pegawai()
{
    return Pegawai::paginate(10);
}

function skpd()
{
    return Skpd::get();
}