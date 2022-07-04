<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusRequest extends FormRequest
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
            'data.description' => 'required|max:50|regex:[^([a-zA-ZáéíóúñÁÉÍÓÚÑ\s])*$]',
            'data.module' => 'required|max:50|regex:[^([a-zA-Z\-\_])*$]',
        ];
    }
}
