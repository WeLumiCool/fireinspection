<?php

namespace App\Http\Controllers;

use App\Point;
use App\TypeBuild;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PointController extends Controller
{
    public function index()
    {
        return view('admin.points.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.points.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Point::create($request->all());
        return redirect()->route('admin.points.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Point $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        return view('admin.points.show', compact('point'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Point $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        return view('admin.points.edit', compact('point'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeBuild  $typeBuild
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Point $point)
    {
        $point->update($request->all());
        return redirect()->route('admin.points.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
        $point->delete();
        return redirect()->route('admin.points.index');
    }

    public function datatableData() {
        return DataTables::of(Point::query())
            ->addColumn('actions', function (Point $point) {
                return view('admin.actions', ['type' => 'points', 'model' => $point]);
            })
            ->make(true);
    }
}
