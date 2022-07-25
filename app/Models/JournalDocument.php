<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'journal_topics_id',
        'title',
        'author',
        'abstract',
        'year'
    ];

    public function journalTopic(){
        return $this->belongsTo(JournalTopic::class,'journal_topics_id');
    }
}
