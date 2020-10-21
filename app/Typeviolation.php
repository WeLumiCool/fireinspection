<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typeviolation extends Model
{
    protected $table = 'type_violations';

    protected $fillable = ['name'];
}
