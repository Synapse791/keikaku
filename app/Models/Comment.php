<?php

namespace Keikaku\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comment';

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
