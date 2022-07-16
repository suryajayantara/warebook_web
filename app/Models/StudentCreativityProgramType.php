<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCreativityProgramType extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_name',
        'aliases',
        'desc'
    ];

    public function creativity()
    {
        return $this->hasMany(StudentCreativityProgram::class);
    }
}
