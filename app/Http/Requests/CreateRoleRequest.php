<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|string|max:20',
            'slug'=>'required|string|max:20',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => "Поле обязательно для заполнения!",
            'slug.required' => "Поле обязательно для заполнения!",
            'name.max' => "Не более 20 символов!",
            'slug.max' => "Не более 20 символов!",
        ];
    }
}
