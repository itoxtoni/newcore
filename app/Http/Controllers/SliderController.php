<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\MasterController;
use App\Http\Function\CreateFunction;
use App\Http\Function\UpdateFunction;
use App\Http\Services\Master\SingleService;
use App\Facades\Model\SliderModel;
use App\Http\Requests\Core\GeneralRequest;
use App\Http\Services\CreateSliderService;
use App\Http\Services\Master\CreateService;
use App\Http\Services\Master\UpdateService;
use Plugins\Response;

class SliderController extends MasterController
{
    public function __construct(SliderModel $model, SingleService $service)
    {
        self::$service = self::$service ?? $service;
        $this->model = $model::getModel();
    }

    public function postCreate(GeneralRequest $request, CreateSliderService $service)
    {
        $data = $service->save($this->model, $request);

        return Response::redirectBack($data);
    }

    public function postUpdate($code, GeneralRequest $request, UpdateService $service)
    {
        $data = $service->update($this->model, $request, $code);

        return Response::redirectBack($data);
    }
}
