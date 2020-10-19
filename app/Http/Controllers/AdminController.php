<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function __construct()
    {
//        return $this->middleware('admin');
    }

    public function index()
    {
        return redirect()->route('admin.dashboard');
    }

    public function dashboard()
    {
        return redirect()->route('admin.builds.index');
    }
}
