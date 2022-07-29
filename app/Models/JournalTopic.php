<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalTopic extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'journal_types_id',
        'title',
        'description',
        'thumbnail_url'
    ];

    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }

    public function journalType(){
        return $this->belongsTo(JournalType::class,'journal_types_id');
    }

    public function journalDocument(){
        return $this->hasMany(JournalDocument::class);
    }


}
