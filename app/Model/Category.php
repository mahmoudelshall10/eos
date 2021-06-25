<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Category extends Model
{
    protected $fillable = ['name','created_by'];

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Project::class,'projects_categories')->withTimestamps();
    }
}
