<?php

namespace Keikaku\Models;

use Illuminate\Database\Eloquent\Model;
use Keikaku\Traits\Uuids;

class Task extends Model
{
    use Uuids;

    public $table = 'task';

    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'estimated_cost',
        'actual_cost',
        'due_date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tasks');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
