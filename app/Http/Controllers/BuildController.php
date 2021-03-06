<?php

namespace App\Http\Controllers;

use App\Build;
use App\Check;
use App\CheckViolation;
use App\History;
use App\Point;
use App\Services\SetHistory;
use App\Type;
use App\TypeBuild;
use App\Violation;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BuildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.builds.index', ['types' => TypeBuild::all()]);
    }

    public function welcome() {
        return view('welcome', ['types' => TypeBuild::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.builds.create', ['types' => TypeBuild::all()]);
    }

    public function insp_create()
    {
        return view('objects.create', ['types' => TypeBuild::all()]);

    }


    public function isp_store(Request $request)
    {
        $build = Build::create($request->all());
        SetHistory::save('Добавил', $build->id, null);

        return redirect()->route('welcome');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $build = Build::create($request->all());
        SetHistory::save('Добавил', $build->id, null);

        return redirect()->route('admin.builds.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Build $build
     * @return \Illuminate\Http\Response
     */
    public function show(Build $build)
    {
        $shield = Point::where('name', 'Пожарный щит')->get();

        return view('admin.builds.show', compact('build', 'shield'));
    }


    public function insp_show($id)
    {
        $shield = Point::where('name', 'Пожарный щит')->get();

        $build = Build::find($id);


        return view('objects.show', compact('build', 'shield'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Build $build
     * @return void
     */
    public function edit(Build $build)
    {
        return view('admin.builds.edit', ['build' => $build, 'types' => TypeBuild::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Build $build
     * @return void
     */
    public function update(Request $request, Build $build)
    {
        $build->update($request->all());
        SetHistory::save('Обновил', $build->id, null);
        $build->save();
        return redirect()->route('admin.builds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Build $build
     * @return void
     */
    public function destroy(Build $build)
    {
        $histories = History::all();
        foreach ($histories as $history) {
            if ($history->object_id === $build->id) {
                $history->delete();
            }
        }
        foreach ($build->checks as $check)
        {
            $check->delete();
        }

        $build->delete();
        return redirect()->route('admin.builds.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function datatableData()
    {
        return DataTables::of(Build::query())
            ->addColumn('actions', function (Build $build) {
                return view('admin.actions', ['type' => 'builds', 'model' => $build]);

            })
            ->editColumn('type_id', function (Build $build) {
                $type = TypeBuild::find($build->type_id);
                return $type['name'];
            })
            ->make(true);
    }

    public function welcomedatatableData()
    {
        return DataTables::of(Build::query())
            ->editColumn('type_id', function (Build $build) {
                $type = TypeBuild::find($build->type_id);
                return $type['name'];
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function map()
    {
        return view('objects.maps', ['builds' => Build::all(), 'checks' => Check::all(), 'types' => TypeBuild::all()]);
    }

    public function map_ajax(Request $request) {

        if ($request->district === "0" && $request->type === "0")
        {
            $builds = Build::all();
        }
        elseif ($request->district === "0")
        {
            $builds = Build::where('type_id', $request->type)->get();
        }
        elseif ($request->type === "0")
        {
            $builds = Build::where('district', $request->district)->get();
        }
        else {
            $builds = Build::where('district', $request->district)
                ->where('type_id', $request->type)->get();
        }
        $view = view('maps', compact('builds'))->render();
        return response()->json([
            'view' => $view,
        ]);
    }
}
