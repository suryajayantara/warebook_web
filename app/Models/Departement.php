<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    /**
     * departement_name : digunakan untuk menginput data nama jurusan yang bertipe string
     * desc : digunakan untuk menginput data deskripsi yang bertipe text
     */
    use HasFactory;
    protected $fillable = [
        'departement_name',
        'desc'
    ];

    // fungsi ini digunakan untuk melakukan relasi dengan model Study
    public function study()
    {
        return $this->hasMany(Study::class);
    }

    // fungsi ini digunakan untuk melakukan relasi dengan model UserDetail
    public function userdetail()
    {
        return $this->hasMany(UserDetail::class);
    }

}
