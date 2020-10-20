<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeBuild extends Model
{
    protected $fillable = ['name'];

    public function builds()
    {
        return $this->hasMany(Build::class, 'type_id');
    }
}
