<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateProjectTypeRequest extends FormRequest
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
            'project_type.description' => [
                'required',
                'max:50',
                'regex:[^([a-zA-Z0-9áéíóúñÁÉÍÓÚÑ\s])*$]',
                'unique:project_types,description,'.$request['project_type.id'],
            ],
        ];
    }
}
