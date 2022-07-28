<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalType extends Model
{
    use HasFactory;
    protected $fillable = [
        'journal_types'
    ];

    public function journalDocument()
    {
        return $this->hasMany(JournalDocument::class);
    }
}
