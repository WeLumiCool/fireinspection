<?php

namespace App;

use App\User;
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
        return $this->hasMany(Violation::class);
    }

}
