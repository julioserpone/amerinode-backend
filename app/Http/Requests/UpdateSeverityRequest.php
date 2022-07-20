<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateSeverityRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data.code' => 'required|max:50|regex:[^([a-zA-Z0-9áéíóúñÁÉÍÓÚÑ\-\_\s])*$]',
            'data.name' => 'required|max:50|regex:[^([a-zA-Z0-9áéíóúñÁÉÍÓÚÑ\-\_\s])*$]',
            'data.description' => 'required|max:50|regex:[^([a-zA-Z0-9áéíóúñÁÉÍÓÚÑ\-\_\s])*$]',
            'color' => [
                'required',
                'max:7',
                'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
            ],
        ];
    }
}
