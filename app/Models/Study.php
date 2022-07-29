<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{

    use HasFactory;
    protected $fillable = [
        'departement_id',
        'studies_name',
        'desc'
    ];

    public function departements()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
