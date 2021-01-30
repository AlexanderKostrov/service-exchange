<?php


namespace App\Http\Services\API;


class StatusService
{
    static function changeStatus($model, $type)
    {
        $model->update(['status' => $type]);
    }
}
