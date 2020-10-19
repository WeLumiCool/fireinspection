<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeBuild extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function builds()
    {
        return $this->hasMany(Build::class, 'type_id');
    }
}
