<?php

namespace App\Http\Controllers;

use App\Build;
use App\History;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HistoryController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }

    public function datatableData(Build $build)
    {
        return DataTables::of(History::where('object_id', $build->id))
            ->editColumn('user_id', function (History $history) {
                return $history->user->name;
            })
            ->editColumn('object_id', function (History $history) {
                return $history->build->address;
            })
            ->editColumn('stage_id', function (History $history) {
                if (!is_null($history->stage)) {
                    return $history->stage->stage;
                }
            })
            ->editColumn('created_at', function (History $history) {
                return $history->created_at->format('d-m-Y H:i');
            })
            ->make(true);
    }
}
