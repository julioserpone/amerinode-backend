<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'project.name' => 'required|max:100|regex:[^([a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,\-\+\&()\s])*$]',
            'project.description' => 'required|max:100|regex:[^([a-zA-Z0-9áéíóúñÁÉÍÓÚÑ.,\-\+\&()\s])*$]',
        ];
    }
}
