<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'thesis_type',
        'thumbnail_url',
        'title',
        'abstract'
    ];


    public function documents(){
        return $this->hasMany(ThesisDocument::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

}
