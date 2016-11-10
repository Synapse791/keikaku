<?php

namespace Keikaku\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'category';

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
