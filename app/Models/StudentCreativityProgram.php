<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCreativityProgram extends Model
{
    /**
     * users_id : digunakan untuk menyimpan data mahasiswa berdasarkan id yang diambil dari tabel users atau sebagai foreign key dengan tipe data bigint
     * creativity_type : digunakan untuk menyimpan bidang PKM dengan tipe data string
     * abstract : digunakan untuk menyimpan abstract pada dokument PKM dengan tipe data text
     * title : diguankan untuk menyimpan judul dari PKM denga tipe data string
     * aliases : digunakan untuk menyimpan nama singkat dari bidang PKM dengan tipe data string
     * supervisor : digunakan untuk menyimpan nama dosen pembimbing PKM dengan tipe data string
     * document_url : digunakan untuk menyimpan data dokument PKM dengan tipe data string
     */
    use HasFactory;
    protected $fillable = [
        'users_id',
        'creativity_type',
        'aliases',
        'title',
        'abstract',
        'supervisor',
        'document_url'
    ];

    //fungsi ini digunakan untuk melakukan relasi dengan model User
    public function users()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
