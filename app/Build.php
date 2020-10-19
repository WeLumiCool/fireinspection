<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    use HasFactory;
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
