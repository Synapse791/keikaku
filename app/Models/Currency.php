<?php

namespace Keikaku\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public $table = 'currency';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'name',
        'symbol',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
