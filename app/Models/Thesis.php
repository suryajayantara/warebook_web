<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    /**
     * users_id : digunakan untuk menyimpan data mahasiswa berdasarkan id pada tabel users atau sebagai foreign key dengan tipe data bigint
     * thesis_type : digunakan untuk menyimpan data tipe thesis dengan tipe data enum Tugas Akhir dan Skripsi
     * thumbnail_url : digunakan untuk menyimpan data gambar thumbnail dengan tipe data string
     * created_year : digunakan untuk menyimpan tahun pembuatan thesis dengan tipe data integer
     * title : digunakan untuk menyimpan judul program studi dengan tipe data string
     * abstract : digunakan untuk menyimpan abstrak thesis denga tipe data text
     * tags : digunakan untuk menyimpan tags thesis dengan tipe data text
     */
    use HasFactory;

    protected $fillable = [
        'users_id',
        'thesis_type',
        'title',
        'created_year',
        'abstract',
        'tags'
    ];

    // fungsi ini digunakan untuk melakukan relasi dengan model Document
    public function documents(){
        return $this->hasMany(ThesisDocument::class);
    }

    // fungsi ini digunakan untuk melakukan relasi dengan model User
    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }

}
