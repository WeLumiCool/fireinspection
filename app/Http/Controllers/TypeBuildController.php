<?php

namespace App\Http\Controllers;

use App\Point;
use App\TypeBuild;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TypeBuildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.typeBuilds.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.typeBuilds.create', ['points' => Point::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = TypeBuild::create($request->all());
        $type->points()->attach($request->points);
        $type->save();
        return redirect()->route('admin.typeBuilds.index');
    }

    /**
     * Display the specified resource.
     *
     * @param TypeBuild $typeBuild
     * @return \Illuminate\Http\Response
     */
    public function show(TypeBuild $typeBuild)
    {
        $points = [];
        foreach ($typeBuild->points as $point)
        {
            $points[] = $point;
        }

        return view('admin.typeBuilds.show', compact('typeBuild', 'points'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeBuild  $typeBuild
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeBuild $typeBuild)
    {
        return view('admin.typeBuilds.edit', compact('typeBuild'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeBuild  $typeBuild
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeBuild $typeBuild)
    {
        $typeBuild->update($request->all());
        return redirect()->route('admin.typeBuilds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeBuild  $typeBuild
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeBuild $typeBuild)
    {
        $typeBuild->delete();
        return redirect()->route('admin.typeBuilds.index');
    }

    public function datatableData() {
        return DataTables::of(TypeBuild::query())
            ->addColumn('actions', function (TypeBuild $typeBuild) {
                return view('admin.actions', ['type' => 'typeBuilds', 'model' => $typeBuild]);
            })
            ->make(true);
    }
}
