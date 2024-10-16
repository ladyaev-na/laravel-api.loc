<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    //Правила валидации

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'sex' => 'required|boolean',
            'birthday' => 'required|date:Y-m-d',
            'login' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:255'
        ];
    }
    //Кастомные сообшение об ошибках
    public function messages(): array{
        return [

            'surname.required' => 'Фамилия обязательна для заполнения',
            'name.required' => 'Имя обязательна для заполнения',
            'birthday.required' => 'Дата рождения обязательна для заполнения',
            'login.required' => 'Логин обязательна для заполнения',
            'email.required' => 'Почта обязательна для заполнения',
            'sex.required' => 'Пол обязателен для заполнения',


            'name.max' => 'Имя должно состоять из 255 символов',
            'surname.max' => 'Имя должно состоять из 255 символов',
            'patronymic.max' => 'Отчество должно состоять из 255 символов',
            'login.max' => 'Логин должен состоять из 255 символов',
            'email.max' => 'Почта должна состоять из 255 символов',
            'password.max' => 'Пароль должен состоять из 255 символов',

            'birthday.date' => 'Дата рождения должна быть в формате YYYY-MM-DD',

            'login.unique' => 'Логин уже существует',
            'email.unique' => 'Почта уже существует',

            'sex.boolean' => 'Введите: 0 если женский, 1 - если мужской',
            'email.email' => 'Поле электронной почты должно содержать действительный адрес электронной почты',
        ];
    }
}
