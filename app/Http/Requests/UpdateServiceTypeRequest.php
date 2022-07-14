<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateServiceTypeRequest extends FormRequest
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
            'service_type.description' => [
                'required',
                'max:50',
                'regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\s])*$]',
                'unique:service_types,description,'.$request['service_type.id'],
            ],
        ];
    }
}
