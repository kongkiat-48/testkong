<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class InsertWorkStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'statusName'    => 'required|string|regex:/^[\p{L}0-9 ]+$/u',
            'statusUse'     => 'required|integer',
            'status'        => 'required|integer',
            'flagType'      => 'required|string|regex:/^[\p{L}0-9 ]+$/u',
        ];
    }
}
