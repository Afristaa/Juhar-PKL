<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dudi extends Model
{
    protected $fillable = ['nama_dudi', 'bidang_usaha', 'alamat', 'direktur_dudi', 'pembimbing_dudi', 'kontak'];

    public function Siswas()
    {
        return $this->hasOne(Siswa::class, 'id_dudi');
    }
}
