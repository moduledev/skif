<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
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
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'image' =>'image|max:10240',
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
            'name.required' => "Заполните поле имя!",
            'surname.required' => "Заполните поле фамилия!",
            'email.required' => 'Заполните поле имя E-mail!',
            'email.unique' => 'Email уже существует!',
            'password.required' => 'Введие пароль!',
            'password.min' => 'Длина пароля не менее 8 символов!',
            'image' => 'Только изображения!',
            'image.max' => 'Не больше 5 Мб!',
        ];
    }
}
