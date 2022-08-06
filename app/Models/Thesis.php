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
        'created_year',
        'title',
        'created_year',
        'abstract',
        'tags'
    ];


    public function documents(){
        return $this->hasMany(ThesisDocument::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }

}
