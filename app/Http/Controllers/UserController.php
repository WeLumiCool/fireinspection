<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function change_permission()
    {
        $zam = Role::where('role', 'Заместитель')->first();
        $zam->is_admin = !$zam->is_admin;
        $zam->save();
        return response()->json('',204);
    }
}
