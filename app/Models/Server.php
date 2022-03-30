<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = [
        'private_key',
        'password'
    ];

    public function isPasswordAuthentication()
    {
        return $this->authentication_type == 'password';
    }

    public function isPrivateKeyAuthentication()
    {
        return $this->authentication_type == 'private_key';
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        self::deleting(function(self $server){
            $server->projects->each(function($project){
                $project->delete();
            });
        });
    }
}
