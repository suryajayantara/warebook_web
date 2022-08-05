<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JournalTopic extends Model
{
    /**
     * users_id : digunakan untuk menyimpan data dosen berdasarkan idnya yang diambil dari tabel users atau sebagai foreign key dengan tipe data bigint
     * journal_types_id : digunakan untuk menyimpan data tipe journal berdasarkan idnya yang mengambil dari tabel journal_types atau sebagai foreign key dengan tipe data bigint
     * title : digunakakan untuk menyimpan judul dari journal topic dengan tipe data string
     * description : digunakan untuk menyimpan deskripsi dari journal topic dengan tipe data text
     * thumbnail_url : digunakan untuk menyimpan gambar thumbnail journal topic dengan tipe data string
     */
    use HasFactory;
    protected $fillable = [
        'users_id',
        'journal_types_id',
        'title',
        'description',
    ];

    //fungsi ini digunakan untuk melakukanan relasi dengan model User
    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }

    //fungsi ini digunakan untuk melakukan relasi dengan model JournalType
    public function journalType(){
        return $this->belongsTo(JournalType::class,'journal_types_id');
    }

    //fungsi ini digunakan untuk melakukan relasi dengan model JournalDocument
    public function journalDocument(){
        return $this->hasMany(JournalDocument::class);
    }


}
