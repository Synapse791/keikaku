<?php

namespace Keikaku\Models;

use Illuminate\Database\Eloquent\Model;
use Keikaku\Traits\Uuids;

class Comment extends Model
{
    use Uuids;

    public $table = 'comment';

    public $incrementing = false;

    protected $fillable = [
        'content',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
