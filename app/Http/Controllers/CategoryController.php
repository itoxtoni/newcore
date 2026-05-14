<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\MasterController;
use App\Http\Function\CreateFunction;
use App\Http\Function\UpdateFunction;
use App\Models\Category;
use App\Services\Master\SingleService;
use Illuminate\Support\Facades\Log;

class CategoryController extends MasterController
{
    use CreateFunction;
    use UpdateFunction;

    public function __construct(Category $model, SingleService $service)
    {
        self::$service = self::$service ?? $service;
        $this->model = $model::getModel();
    }

    public function postTest()
    {
        Log::info('masuk sini');
        return request()->all();
    }
}
