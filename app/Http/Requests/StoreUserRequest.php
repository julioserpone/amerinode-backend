<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'user.title' => 'required|max:25|regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\.,\s])*$]',
            'user.name' => 'required|max:50|regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\.,\s])*$]',
            'user.username' => 'required|max:20|regex:[(?!^[@\.\_\-\d])(?!.*[@\.\_\-]$)(?!.*[@\.\_\-]{2,})^([a-zA-Z0-9\-\_\.]{4,20})+$]',
            'user.email' => [
                'required',
                'email:rfc,spoof,filter',
                'unique:users,email',
            ],
            'user.mobile_phone' => 'required|regex:[^([0-9#()+\-\.,\s])*$]',
            'user.work_phone' => 'required|regex:[^([0-9#()+\-\.,\s])*$]',
            'user.password' => ['required', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()]
        ];
    }
}
