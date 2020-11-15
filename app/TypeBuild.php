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

    public function points()
    {
        return $this->belongsToMany(Point::class, 'point_type', 'type_id', 'point_id')->withTimestamps();
    }
}
