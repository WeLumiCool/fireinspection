<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkpoint extends Model
{
    protected $fillable = [
        'check_id',
        'point_id',
        'value'
    ];

    public function check()
    {
        return $this->belongsTo(Check::class);
    }

    public function point()
    {
        return $this->belongsTo(Point::class);
    }
}
