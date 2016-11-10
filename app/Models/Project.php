<?php

namespace Keikaku\Models;

use Illuminate\Database\Eloquent\Model;
use Keikaku\Traits\Uuids;

class Project extends Model
{
    use Uuids;

    public $table = 'project';

    public $incrementing = false;

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
