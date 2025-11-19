<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable= [
        'id_dudi',
        'id_kelas',
        'id_user',
        'nis',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'id_pembimbing',
        'foto',

    ];

    public function  user() {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function  pembimbing() {
    return $this->belongsTo(User::class, 'id_pembimbing');
}
    public function kelas() {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function dudi() {
    return $this->belongsTo(Dudi::class, 'id_dudi');
}
    public function kegiatan() {
    return $this->hasMany(Kegiatan::class, 'id_siswa');
    }
    public function absensi()  {
        return $this->hasMany(Absensi::class, 'id_siswa');
    }
}
      
    
