<?php
/**
 * Created by PhpStorm.
 * User: damir
 * Date: 8/26/20
 * Time: 14:00
 */

namespace App\Services;


use App\History;

class SetHistory
{
    public static function save($action, $object_id, $check_id)
    {
        $history = new History();
        $history->user_id = auth()->user()->id;
        $history->action = $action;
        $history->object_id = $object_id;
        $history->check_id = $check_id;
        $history->save();
    }
}
