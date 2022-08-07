<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalDocument extends Model
{
    /**
     * journal_topics_id : digunakan untuk menyimpan data journal topic berdasarkan id yang diambil dari tabel journal_topics atau digunakan sebagai foreign key dengan tipe data bigint
     * title : digunakan untuk menyimpan judul journal dengan tipe data string
     * author : digunakan untuk menyimpan author dari journal dengan tipe data text
     * abstract : digunakan untuk menyimpan abstract dari jounal dengan tipe data text
     * year : digunakan untuk menyimpan tahun pembuatan journal dengan tipe data string
     * doi : digunakan untuk menyimpan Digital object identifier dengan tipe data string
     * tags : digunakan untuk menyimpan kata kunci journal dengan tipe data string
     * original_url : digunakan untuk menyimpan original dokument dari publisher dengan tipe data string
     * file_name : digunakan untuk menyimpan nama data dokumen dengan tipe data string
     * document_url : digunakan untuk menyimpan dokument jurnal dengan tipe data string
     */
    use HasFactory;
    protected $fillable = [
        'users_id',
        'journal_topics_id',
        'title',
        'author',
        'abstract',
        'year',
        'tags',
        'doi',
        'original_url',
        'document_url',
    ];

    //fungsi ini digunakan untuk melakukanan relasi dengan model User
    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }

    //digunakan untuk melakukan relasi dengan model JournalTopic
    public function journalTopic(){
        return $this->belongsTo(JournalTopic::class,'journal_topics_id');
    }


}
