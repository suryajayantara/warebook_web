<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;
    protected $fillable = [
        'departement_name',
        'desc'
    ];

    public function study()
    {
        return $this->hasMany(Study::class);
    }

    public function users()
    {
        return $this->hasMany(UserDetail::class);
    }

}
