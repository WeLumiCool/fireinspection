<?php

namespace App\Http\Controllers;

use App\Typeviolation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TypeViolationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Typeviolation::create($request->all());
        return redirect()->route('admin.typeViolations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Typeviolation $typeViolation
     * @return \Illuminate\Http\Response
     */
    public function show(Typeviolation $typeViolation)
    {
        return view('admin.types.show', compact('typeViolation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Typeviolation $typeViolation
     * @return \Illuminate\Http\Response
     */
    public function edit(Typeviolation $typeViolation)
    {
        return view('admin.types.edit', compact('typeViolation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Typeviolation $typeViolation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Typeviolation $typeViolation)
    {
        $typeViolation->update($request->all());
        return redirect()->route('admin.typeViolations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Typeviolation $typeViolation
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Typeviolation $typeViolation)
    {
        $typeViolation->delete();
        return redirect()->route('admin.types.index');
    }
    public function datatableData() {
        return DataTables::of(Typeviolation::query())
            ->addColumn('actions', function (Typeviolation $typeViolation) {
                return view('admin.actions', ['type' => 'typeViolations', 'model' => $typeViolation]);
            })
            ->make(true);
    }
}
