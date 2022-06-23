<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            'role.name' => [
                'required',
                'max:50',
                'regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\s])*$]',
                'unique:roles,name',
            ],
            'role.guard_name' => 'required|max:50|regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\s])*$]',
            'role.description' => 'required|max:100|regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\.,:()\s])*$]',
        ];
    }
}
