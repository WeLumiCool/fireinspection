<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable =
        [
            'name',

        ];


    public function checks()
    {
        return $this->belongsToMany(Check::class, 'check_violation', 'violation_id')->withPivot('note')->withTimestamps();
    }
}
