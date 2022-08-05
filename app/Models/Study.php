<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    /**
     * departement_id : digunakan untuk menyimpan data jurusan berdasarkam id yang diambil dari tabel departements atua sebagai foreign key denga tipe data bigint
     * studies_name : digunakan untuk menyimpan nama program studi dengan tipe data string
     * desc : digunakan untuk menyimpan deskripsi program studi
     */
    use HasFactory;
    protected $fillable = [
        'departement_id',
        'studies_name',
        'desc'
    ];

    // fungsi ini digunakan untuk melakukan relasi dengan model Departement
    public function departements()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    // fungsi ini digunakan untuk melakukan relasi dengan model UserDetail
    public function userdetail()
    {
        return $this->hasMany(UserDetail::class);
    }
}
