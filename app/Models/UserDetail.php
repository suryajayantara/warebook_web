<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'unique_id',
        'departement_id',
        'study_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }

    public function departements()
    {
        return $this->belongsTo(Departement::class,'departement_id');
    }

    public function study()
    {
        return $this->belongsTo(Study::class,'study_id');
    }
}
