<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeViolation extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function violations()
    {
        return $this->hasMany(Violation::class, 'type_id');
    }
}
