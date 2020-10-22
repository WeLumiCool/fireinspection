<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'date',
        'user_id',
        'action',
        'object_id',
        'stage_id',
    ];

    public function build()
    {
        return $this->belongsTo(Build::class, 'object_id');
    }

    public function check()
    {
        return $this->belongsTo(Check::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
