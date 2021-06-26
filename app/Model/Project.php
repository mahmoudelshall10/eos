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
        ,'status'
        ,'description'
        ,'created_by'  // who uploads this projects admin or researcher
        ,'researcher_id' // who belongs this project

    ];

    const HIDDEN        = 'hidden';
    const ALLUSERS      = 'all_users';
    const SPECIFICUSERS = 'specific_users';

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

    public function users()
    {
        return $this->belongsToMany(ProjectUsers::class,'project_users','project_id','user_id')
        ->withPivot(['status'])
        ->withTimestamps();
    }

    // public function manyUsers()
    // {
    //     return $this->hasMany(ProjectUsers::class,'project_id','user_id');
    //     // return $this->belongsToMany(ProjectUsers::class,'project_users','project_id','user_id')
    //     // ->withTimestamps();
    // }

    public function scopeSearch($q)
    {
        $query = request()->search;
        return empty($query) ? $q : 
        $q->where('name', 'LIKE', "%{$query}%")
        ->orWhere('description', 'LIKE', "%{$query}%")
        ->orWhereHas('categories', function ($qu) use ($query) {
            $qu->where('name', 'LIKE', "%{$query}%");
        });
        
    }

    protected $casts = [
        'status' => 'enum',
    ];



}
