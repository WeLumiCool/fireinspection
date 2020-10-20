<?php

namespace App\Http\Controllers;

use App\Type;
use App\TypePsp;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TypePspController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.psps.index');
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
        TypePsp::create($request->all());
        return redirect()->route('admin.psps.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypePsp  $typePsp
     * @return \Illuminate\Http\Response
     */
    public function show(TypePsp $Psp)
    {
        return view('admin.psps.show', compact('Psp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypePsp  $typePsp
     * @return \Illuminate\Http\Response
     */
    public function edit(TypePsp $Psp)
    {
        return view('admin.psps.edit', compact('Psp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypePsp  $typePsp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypePsp $Psp)
    {
        $Psp->update($request->all());
        return redirect()->route('admin.psps.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypePsp  $typePsp
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypePsp $Psp)
    {
        $Psp->delete();
        return redirect()->route('admin.psps.index');
    }

    public function datatableData() {
        return DataTables::of(TypePsp::query())
            ->addColumn('actions', function (TypePsp $Psp) {
                return view('admin.actions', ['type' => 'psps', 'model' => $Psp]);
            })
            ->make(true);
    }
}
