<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCreativityProgram extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'creativity_type',
        'title',
        'abstract',
        'thumbnail_url',
        'supervisor',
        'document_url'
    ];
}
