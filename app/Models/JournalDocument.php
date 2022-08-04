<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalDocument extends Model
{
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
        'document_url'
    ];

    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }
    
    public function journalTopic(){
        return $this->belongsTo(JournalTopic::class,'journal_topics_id');
    }

    
}
