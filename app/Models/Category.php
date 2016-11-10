<?php

namespace Keikaku\Models;

use Illuminate\Database\Eloquent\Model;
use Keikaku\Traits\Uuids;

class Category extends Model
{
    use Uuids;

    public $table = 'category';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'name',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
