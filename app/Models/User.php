<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // fungsi ini digunakan untuk melakukan relasi dengan model Thesis

    public function theses(){
        return $this->hasOne(Thesis::class, 'users_id', 'id');
    }

    // fungsi ini digunakan untuk melakukan relasi dengan model StudentCreativityProgram
    public function creativity(){
        return $this->hasOne(StudentCreativityProgram::class, 'users_id', 'id');
    }

    // fungsi ini digunakan untuk melakukan relasi dengan model InternalResearch
    public function internalResearch(){
        return $this->hasOne(InternalResearch::class, 'users_id', 'id');
    }

    // fungsi ini digunakan untuk melakukan relasi dengan model UserDetail
    public function details(){
        return $this->hasOne(UserDetail::class, 'users_id', 'id');
    }

    // fungsi ini digunakan untuk melakukan relasi dengan model JournalTopic
    public function journalTopic(){
        return $this->hasOne(JournalTopic::class, 'users_id', 'id');
    }

    // fungsi ini digunakan untuk melakukan relasi dengan model JournalTopic
    public function journalDocument(){
        return $this->hasOne(JournalDocument::class, 'users_id', 'id');
    }
}
