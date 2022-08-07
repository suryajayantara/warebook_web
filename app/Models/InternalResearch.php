<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalResearch extends Model
{
    /**
     * users_id : digunakan untuk menginput data dosen berdasarkan id yang bertipe bigint yang didapatkan dari table users atau users_id digunakan sebagai foreign key
     * title : digunakan untuk menyimpan judul internal research dengan tipe data string
     * abstract : digunakan untuk menyimpan data abstract dokumen dengan tipe data text
     * thumbnail_url : digunakan untuk meyimpan gambar thumbnail dengan tipe data string
     * budget_type : digunakan untuk meyimpan tipe budget dengan tipe data string
     * budget : digunakan untuk meyimpan nilai budget dengan tipe data bigint
     * project_started_at : digunakan untuk meyimpan waktu dan tanggal mulai project dengan tipe data datetime
     * project_finish_at : digunakan untuk meyimpan waktu dan tanggal project tersebut selesai dengan tipe data datetime
     * contract_number : digunakan untuk meyimpan nomor kontrak dengan tipe data contract_number dengan tipe data string
     * team_member : digunakan untuk meyimpan team member pada internal research dengan tipe data text
     * file_name_doc : digunakan untuk menyimpan nama data dokumen dengan tipe data string
     * file_name_prop : digunakan untuk menyimpan nama data proposal dengan tipe data string
     * proposal_url : digunakan untuk meyimpan dokument proposal internal research dengan tipe data text
     * document_url : digunakan untuk meyimpan dokument internal research dengan tipe data text
     */
    use HasFactory;
    protected $fillable = [
        'users_id',
        'title',
        'abstract',
        'budget_type',
        'budget',
        'project_started_at',
        'project_finish_at',
        'contract_number',
        'team_member',
        'proposal_url',
        'document_url'
    ];

    //fungsi ini digunakan untuk relasi dengan model User
    public function users()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
