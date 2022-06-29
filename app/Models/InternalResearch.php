<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalResearch extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'title',
        'abstract',
        'thumbnail_url',
        'budget_type',
        'budget',
        'project_started_at',
        'project_finish_at',
        'contract_number',
        'team_member',
        'contract_url',
        'proposal_url',
        'document_url'
    ];
}
