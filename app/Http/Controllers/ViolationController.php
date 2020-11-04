<?php

namespace App\Http\Controllers;

use App\Violation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ViolationController extends Controller
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
        Violation::create($request->all());
        return redirect()->route('admin.violations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Violation  $violation
     * @return \Illuminate\Http\Response
     */
    public function show(Violation $violation)
    {
        return view('admin.violations.show', compact('violation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Violation  $violation
     * @return \Illuminate\Http\Response
     */
    public function edit(Violation $violation)
    {
        return view('admin.types.edit', compact('violation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Violation  $violation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Violation $violation)
    {
        $violation->update($request->all());
        return redirect()->route('admin.violations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Violation  $violation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Violation $violation)
    {
        $violation->delete();
        return redirect()->route('admin.violations.index');
    }
    public function datatableData() {
        return DataTables::of(Violation::query())
            ->addColumn('actions', function (Violation $violation) {
                return view('admin.actions', ['type' => 'violations', 'model' => $violation]);
            })
            ->make(true);
    }
}
