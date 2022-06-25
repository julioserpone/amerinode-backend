<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdatePermissionRequest extends FormRequest
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
     * @param Request $request
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        return [
            'permission.name' => [
                'required',
                'max:50',
                'regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\-\s])*$]',
                'unique:roles,name,'.$request['permission.id'],
            ],
            'permission.guard_name' => 'required|max:50|regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\s])*$]',
            'permission.description' => 'required|max:100|regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\.,:\-()\s])*$]',
        ];
    }
}
