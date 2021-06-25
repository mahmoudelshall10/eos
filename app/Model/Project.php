<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Category;

class Project extends Model
{
    protected $fillable = 
    [
        'name' 
        ,'uuid'
        ,'description'
        ,'created_by'  // who uploads this projects admin or researcher
        ,'researcher_id' // who belongs this project

    ];

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function researcher()
    {
        return $this->belongsTo(User::class, 'researcher_id', 'id');
    }

    public function files()
    {
        return $this->hasMany(ProjectFiles::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'project_categories')->withTimestamps();
    }


}
