<?php

namespace Keikaku\Models;

use Illuminate\Database\Eloquent\Model;
use Keikaku\Traits\Uuids;

class Currency extends Model
{
    use Uuids;

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
