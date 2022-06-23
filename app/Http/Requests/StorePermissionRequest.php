<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
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
            'permission.name' => [
                'required',
                'max:50',
                'regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\s])*$]',
                'unique:permissions,name',
            ],
            'permission.guard_name' => 'required|max:50|regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\s])*$]',
            'permission.description' => 'required|max:100|regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\.,:()\s])*$]',
        ];
    }
}
