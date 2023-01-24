<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class CreateUserRequest extends FormRequest
{
    /**
     * @var string
     */
    protected $redirect = '/';

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
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|required_with:password_confirmation',
            'confirmPassword' => 'required|min:5'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Заполните поле Имя',
            'lastName.required' => 'Заполните поле Фамилия',
            'email.required' => 'Заполните поле Email',
            'email.email' => 'Email не валидный',
            'password.required' => 'Заполните поле Пароль',
            'password.min' => 'Минимальная длина 5 символов',
            'password.required_with' => 'Пароли не совпадают',
            'confirmPassword.required' => 'Заполните поле Пароль',
            'confirmPassword.min' => 'Минимальная длина 5 символов',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        \Log::info('Email: '.$this->email.' '. json_encode($validator->errors()));
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }


    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {

            if ($this->password != $this->confirmPassword) {
                $validator->errors()->add('confirmPassword', 'Пароли не совпадают');
            }
        });
    }

}
