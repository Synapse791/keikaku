<?php

namespace Keikaku\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Keikaku\Traits\Uuids;

class User extends Authenticatable
{
    use Notifiable, Uuids;

    public $table = 'user';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'user_projects');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'user_tasks');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
