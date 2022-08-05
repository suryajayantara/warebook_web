<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JournalTopic extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'subject',
        'title',
        'description',
        'thumbnail_url'
    ];

    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }

    public function journalDocument(){
        return $this->hasMany(JournalDocument::class);
    }


}
