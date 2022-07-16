<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'thesis_id',
        'document_name',
        'url'
    ];

    public function thesis()
    {
        return $this->belongsTo(Thesis::class,'thesis_id');
    }
}
