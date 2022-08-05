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
     * year : digunakan untuk menyimpan tahun pembuatan journal dengan tipe data year
     * url : digunakan untuk menyimpan dokument jurnal dengan tipe data string
     */
    use HasFactory;
    protected $fillable = [
        'journal_topics_id',
        'title',
        'author',
        'abstract',
        'url',
        'year'
    ];

    //fungsi ini digunakan untuk relasi dengan model JournalTopic
    public function journalTopic(){
        return $this->belongsTo(JournalTopic::class,'journal_topics_id');
    }
}
