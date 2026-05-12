<?php

namespace App\Http\Requests\Core;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    use ValidationTrait;

    public function validation(): array
    {
        return [
            'start_report' => 'required',
            'end_report' => 'required',
            'customer_code' => 'required',
        ];
    }
}
