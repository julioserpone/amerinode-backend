<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateTechnologyRequest extends FormRequest
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
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        return [
            'technology.description' => [
                'required',
                'max:100',
                'regex:[^([0-9a-zA-ZáéíóúñÁÉÍÓÚÑ\.,:\-\+()\s])*$]',
                'unique:technologies,description,'.$request['technology.id'],
            ],
        ];
    }
}
