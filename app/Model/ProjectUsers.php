<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProjectUsers extends Model
{
    // protected $table = 'project_users';
    protected $fillable = 
    [
        'project_id',
        'user_id',
        'status'
    ];

    protected $primaryKey = ['project_id','user_id'];
    public $incrementing = false;

    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'id', 'project_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
