<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisDocument extends Model
{
    /**
     * thesis_id : digunakan untuk menyimpan data thesis beradasarkan id dari tabel Thesis atau digunakan sebagai foreign key dengan tipe data bigint
     * document_name : digunakan untuk menyimpan nama dokumen thesis dengan tipe data string
     * file_name : digunakan untuk menyimpan nama data dokumen dengan tipe data string
     * document_url : digunakan untuk menyimpan data dokumen dengan tipe data string
     */
    use HasFactory;
    protected $fillable = [
        'thesis_id',
        'document_name',
        'file_name',
        'document_url'
    ];

    // fungsi ini digunakan untuk melakukan relasi dengan model Thesis
    public function thesis()
    {
        return $this->belongsTo(Thesis::class,'thesis_id');
    }
}
