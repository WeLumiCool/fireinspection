<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'note',
            'type_id',
            'check_id',
        ];

    public function check()
    {
        return $this->belongsTo(Check::class);
    }

    public function type()
    {
        return $this->belongsTo(TypeViolation::class, 'type_id');
    }
}
