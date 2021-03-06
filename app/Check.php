<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $fillable =
        [
            'has_aups',
            'has_aupt',
            'psp_count',
            'has_hydrant',
            'has_reservoir',
            'has_cranes',
            'has_evacuation',
            'user_id',
            'build_id',
            'type_id',
            'legality'
        ];

    public function build()
    {
        return $this->belongsTo(Build::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function violations()
    {
        return $this->belongsToMany(Violation::class, 'check_violation', 'check_id')->withPivot('note')->withTimestamps();
    }

    public function type()
    {
        return $this->belongsTo(TypeCheck::class);
    }

    public function checkpoints()
    {
        return $this->hasMany(Checkpoint::class);
    }
}
