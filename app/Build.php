<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    protected $fillable =
        [
            'name',
            'address',
            'latitude',
            'longitude',
            'district',
        ];

    public function checks()
    {
        return $this->hasMany(Check::class);
    }

    public function type()
    {
        return $this->belongsTo(TypeBuild::class, 'type_id');
    }
}
