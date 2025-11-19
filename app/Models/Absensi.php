<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = ['id_siswa', 'tanggal', 'jam_masuk', 'jam_keluar', 'status', 'keterangan'];
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
