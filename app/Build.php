<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    protected $fillable =
        [
            'name',
            'address',
            'type_id',
            'latitude',
            'longitude',
            'district',
            'planned_check'
        ];

    public function checks()
    {
        return $this->hasMany(Check::class)->orderBy('created_at', 'desc');
    }

    public function type()
    {
        return $this->belongsTo(TypeBuild::class, 'type_id');
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
