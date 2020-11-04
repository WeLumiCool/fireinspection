<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable =
        [
            'name',

        ];

    public function check()
    {
        return $this->belongsTo(Check::class);
    }

    public function checks()
    {
        return $this->belongsToMany(Check::class);
    }
}
