<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    protected $fillable = 
    [
        'name' 
        , 'job_title' 
        ,'created_by' 
        ,'photo' 
        ,'facebook_url'
        ,'twitter_url'
        ,'linkedIn_url'
        ,'insta_url'

    ];


    /**
     * Get the user associated with the Year
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
