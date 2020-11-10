<?php

namespace App\Http\Controllers;

use App\Build;
use App\Check;
use App\Services\ImageUploader;
use App\Services\SetHistory;
use App\TypeCheck;
use App\TypePsp;
use App\Violation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $typePsps = TypePsp::all();
        $violations = Violation::all();
        $typeChecks = TypeCheck::all();
        $build = Build::find($id);
        return view('admin.checks.create',
            compact(
                'id',
                'typePsps',
                'violations',
                'typeChecks',
                'build'
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function inspector_create($id)
    {
        $typePsps = TypePsp::all();
        $violations = Violation::all();
        $typeChecks = TypeCheck::all();
        $build = Build::find($id);
        return view('checks.create',
            compact(
                'id',
                'typePsps',
                'violations',
                'typeChecks',
                'build'
            ));
    }

    public function general_store($request)
    {
        $check = Check::create($request->only('type_id', 'user_id', 'build_id'));
        $check->has_aups = $request->has('has_aups');
        $check->has_aupt = $request->has('has_aupt');
        $check->has_hydrant = $request->has('has_hydrant');
        $check->has_reservoir = $request->has('has_reservoir');
        $check->has_cranes = $request->has('has_cranes');
        $check->has_evacuation = $request->has('has_evacuation');
        $check->has_foam = $request->has('has_foam');
        $check->has_reservoir = $request->has('has_reservoir');
        $check->legality = $request->has('legality');
//        Дата  запланированной проверки
        $build = Build::find($request->build_id);
        $build->planned_check = $request->planned_check;
//      Кол-во пожарного щита
        if ($request->has('has_shield')) {
            if (is_null($request->has_shield)) {
                $check->has_shild = 0;
            } else {
                $check->has_shild = $request->has_shield;
            }
        }
        //get check images
        if ($request->has('images')) {
            $path_images = [];
            foreach ($request->images as $image) {
                $path_images[] = ImageUploader::upload($image, 'checks', 'check');
            }
            $check->images = json_encode($path_images);
        }
        //get all psps
        if ($request->has('type_psps')) {
            $pspArray = [];
            for ($i = 0; $i < count($request->type_psps); $i++) {
                $pspArray[] =
                    [
                        'type' => $request->type_psps[$i],
                        'count' => $request->counts[$i],
                    ];
            }
            $check->psp_count = json_encode($pspArray);
        }
        SetHistory::save('Проведена проверка', $check->build->id, $check->id);
        //save violations by check
        if ($request->violation) {
            foreach ($request->violation as $k => $value)
            {
                foreach ($request->notes as $key => $note) {
                    if ($k == $key)
                    {
                        if (!is_null($note)){
                            $check->violations()->attach($k, ['note' => $note]);
                        }
                        else
                        {
                            $check->violations()->attach($k, ['note' => null]);
                        }
                    }

                }
            }
        }

        $build->save();
        $check->save();

        return $check;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Route
     */
    public function store(Request $request)
    {
        $check = self::general_store($request);
        return redirect()->route('admin.builds.show', $check->build_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Route
     */
    public function inspector_store(Request $request)
    {
        $check = self::general_store($request);
        return redirect()->route('build.show', $check->build_id);
    }

    /**
     * Display the specified resource.
     *
     * @param Check $check
     * @return void
     */
    public function show(Check $check)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Check $check
     * @return View
     */
    public function edit(Check $check)
    {
        $typePsps = TypePsp::all();
        $violations = Violation::all();
        $typeChecks = TypeCheck::all();
        return view('admin.checks.edit', compact(
            'check',
            'typePsps',
            'violations',
            'typeChecks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Check $check
     * @return Route
     */
    public function update(Request $request, Check $check)
    {
        $check->update($request->only('type_id', 'user_id', 'build_id'));
        $check->has_aups = $request->has('has_aups');
        $check->has_aupt = $request->has('has_aupt');
        $check->has_hydrant = $request->has('has_hydrant');
        $check->has_reservoir = $request->has('has_reservoir');
        $check->has_cranes = $request->has('has_cranes');
        $check->has_evacuation = $request->has('has_evacuation');
        $check->has_foam = $request->has('has_foam');
        //get check images
        if ($request->has('images')) {
            $path_images = [];
            foreach ($request->images as $image) {
                $path_images[] = ImageUploader::upload($image, 'checks', 'check');
            }
            $check->images = json_encode($path_images);
        }
        //get all psps
        if ($request->has('type_psps')) {
            $pspArray = [];
            for ($i = 0; $i < count($request->type_psps); $i++) {
                $pspArray[] =
                    [
                        'type' => $request->type_psps[$i],
                        'count' => $request->counts[$i],
                    ];
            }
            $check->psp_count = json_encode($pspArray);
        } else {
            $check->psp_count = null;
        }
        if ($check->build->type_id == 1 || $check->build->type_id == 5) {
            $check->has_foam = $request->has('has_foam');
            if (!$request->has('has_foam')) {
                $check->legality = "1";
            }
        } else {
            $check->has_foam = NULL;
        }
        if ($check->build->type_id == 5) {
            $check->has_reservoir = $request->has('has_reservoir');
            if (!$request->has('has_reservoir')) {
                $check->legality = "1";
            }
        } else {
            $check->has_reservoir = NULL;
        }
        if ($request->has('has_shild')) {
            $check->has_shild = $request->has_shild;
        }
        $check->build->planned_check = $request->planned_check;

        SetHistory::save('Обновил', $check->build->id, $check->id);

        //save violations by check
        if ($request->violation) {
            $violations = [];
            foreach ($request->violation as $key => $value) {
                $violations[] = (string)$key;
            }
            $check->violations()->sync($violations);

            $check->legality = "1";
        } else {
            $check->violations()->detach();
        }
        if (!$request->has('has_aups')) {
            $check->legality = "1";
        }
        if (!$request->has('has_aupt')) {
            $check->legality = "1";
        }
        if (!$request->has('has_hydrant')) {
            $check->legality = "1";
        }
        if (!$request->has('has_reservoir')) {
            $check->legality = "1";
        }
        if (!$request->has('has_cranes')) {
            $check->legality = "1";
        }
        if (!$request->has('has_evacuation')) {
            $check->legality = "1";
        }
        if (!$request->has('has_foam')) {
            $check->legality = "1";
        }
        $check->save();
        $check->build->save();
        return redirect()->route('admin.builds.show', $check->build_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Check $check
     * @return Route
     * @throws \Exception
     */
    public function destroy(Check $check)
    {
        foreach ($check->violations as $violation) {
            $violation->delete();
        }
        if (!is_null($check->images)) {
            foreach (json_decode($check->images) as $image_path) {
                Storage::disk('public')->delete($image_path);
            }
        }
        $check->delete();
        SetHistory::save('Удалил', $check->build->id, $check->id);

        return redirect()->route('admin.builds.show', $check->build_id);
    }
}
