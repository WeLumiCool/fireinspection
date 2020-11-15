<?php

namespace App\Http\Controllers;

use App\Build;
use App\Check;
use App\Checkpoint;
use App\Point;
use App\Services\ImageUploader;
use App\Services\SetHistory;
use App\TypeCheck;
use App\TypePsp;
use App\Violation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use PhpParser\Node\Stmt\Else_;

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
        $points = [];

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

    public $flag;
    public $flag1;
    public $flag2;

    public function general_store($request)
    {


        $check = Check::create($request->only('type_id', 'user_id', 'build_id'));

//        Дата  запланированной проверки
        $build = Build::find($request->build_id);
        $build->planned_check = $request->planned_check;

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
            $this->flag1 = 1;
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
            $this->flag1 = 0;
        }


        if ($request->points) {
            $shield = Point::where('name', 'Пожарный щит')->get();

            foreach ($request->points as $key => $point) {
                if ($shield[0]->id == $key)
                {
                    Checkpoint::create([
                        'check_id' => $check->id,
                        'point_id' => $key,
                        'value' => $request->has_shield
                    ]);
                } else {
                    Checkpoint::create([
                        'check_id' => $check->id,
                        'point_id' => $key,
                        'value' => '1'
                    ]);
                }

            }
        }
        foreach ($build->type->points as $point) {
            if ($check->checkpoints->contains('point_id', $point->id)) {
                $this->flag = 1;
            } else {
                $this->flag = 0;
            }
        }


        SetHistory::save('Проведена проверка', $check->build->id, $check->id);
        //save violations by check
        if ($request->violation) {
            $this->flag2 = 0;
            $violations = [];
            foreach ($request->violation as $k => $value) {
                $violations[] = $k;
            }
            $check->violations()->attach($violations);
        } else {
            $this->flag2 = 1;
        }


//        dd('flag:',$this->flag, 'flag1:',$this->flag1,'flag2:',$this->flag2);
        if ($this->flag == 0 || $this->flag == null || $this->flag1 == 0 || $this->flag1 == null || $this->flag2 == 0 || $this->flag2 == null) {
            $check->legality = '0';
        } else {
            $check->legality = '1';
        }
//        dd($check->legality);


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

        //Edit checkpoints don't work
        if ($request->points) {

            foreach ($request->points as $key => $item) {

                Checkpoint::where('check_id', $check->id)->update([
                    'check_id' => $check->id,
                    'point_id' => $key,
                    'value' => 1
                ]);
            }
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

        } else {
            $check->violations()->detach();
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
        if (!is_null($check->images)) {
            foreach (json_decode($check->images) as $image_path) {
                Storage::disk('public')->delete($image_path);
            }
        }
        foreach ($check->checkpoints as $checkpoint) {
            $checkpoint->delete();
        }
        $check->violations()->detach();
        $check->delete();
        SetHistory::save('Удалил', $check->build->id, $check->id);

        return redirect()->route('admin.builds.show', $check->build_id);
    }
}
