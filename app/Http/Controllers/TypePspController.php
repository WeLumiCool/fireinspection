<?php

namespace App\Http\Controllers;

use App\TypePsp;
use Illuminate\Http\Request;

class TypePspController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.psp.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.psps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypePsp  $typePsp
     * @return \Illuminate\Http\Response
     */
    public function show(TypePsp $typePsp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypePsp  $typePsp
     * @return \Illuminate\Http\Response
     */
    public function edit(TypePsp $typePsp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypePsp  $typePsp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypePsp $typePsp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypePsp  $typePsp
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypePsp $typePsp)
    {
        //
    }
}
