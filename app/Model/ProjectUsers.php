<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProjectUsers extends Model
{
    protected $fillable = 
    [
        'project_id',
        'user_id',
        'status'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'id', 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id')->where('role_id',3);
    }
}
