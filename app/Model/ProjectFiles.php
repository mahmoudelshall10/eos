<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProjectFiles extends Model
{
    // protected $table    = ['projects_files']; //wrong
    protected $fillable = 
    [
        'uuid',
        'name',
        'project_id',
        'file_path',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class, 'id', 'project_id');
    }
}
