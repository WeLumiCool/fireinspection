<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeCheck extends Model
{
    protected $fillable = ['name'];

    public function checks()
    {
        return $this->hasMany(Check::class);
    }
}
