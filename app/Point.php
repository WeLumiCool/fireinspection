<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = ['name'];

    public function types()
    {
        return $this->belongsToMany(TypeBuild::class, 'point_type', 'point_id', 'type_id')->withTimestamps();
    }

    public function checkpoints()
    {
        return $this->hasMany(Checkpoint::class);
    }
}
