<?php

namespace App\Http\Services\Core;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Plugins\Alert;

class UpdateMenuService
{
    public function update($repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        if ($check['status']) {
            $check['data']->has_link()->sync($data->link);

            if (request()->wantsJson()) {
                return response()->json($check)->getData();
            }
            Alert::update();
        } else {
            Alert::error($check['message']);
        }

        return $check;
    }
}
