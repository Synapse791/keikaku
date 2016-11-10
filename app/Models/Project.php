<?php

namespace Keikaku\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $table = 'project';

    protected $fillable = [
        'title',
        'budget',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_projects');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
