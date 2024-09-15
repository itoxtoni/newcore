<?php

namespace App\Http\Services;

use GeoSot\EnvEditor\Facades\EnvEditor as EnvEditor;
use Plugins\Alert;

class CreateSliderService
{
    public function save($model, $data)
    {
        $check = false;
        try {

            $param = $data->all();

            if ($data->has('images')) {
                $file_logo = $data->file('images');
                $extension = $file_logo->extension();
                $name = time().'.'.$extension;

                $file_logo->storeAs('/public/files/slider/', $name);
                $param['slider_image'] = $name;
            }

            $check = $model->saveRepository($param);
            if (isset($check['status']) && $check['status']) {

                Alert::create();
            } else {
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }



            Alert::update();

        } catch (\Throwable $th) {
            Alert::error($th->getMessage());

            return $th->getMessage();
        }

        return $check;
    }
}
