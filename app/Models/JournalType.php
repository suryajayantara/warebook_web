<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalType extends Model
{
    /**
     * journal_types : digunakan untuk menyimpan tipe journal dengan tipe data string
     */
    use HasFactory;
    protected $fillable = [
        'journal_types'
    ];

    //fungsi ini digunakan untuk melakukan relasi dengan model JournalTopic
    public function journalTopic(){
        return $this->hasMany(JournalTopic::class);
    }
}
