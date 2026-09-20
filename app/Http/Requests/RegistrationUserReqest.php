<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationUserReqest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'last_name' => 'required|regex:/^[а-яА-ЯёЁ]+$/u',
            'first_name' => 'required|regex:/^[а-яА-ЯёЁ]+$/u',
            'middle_name' => 'required|regex:/^[а-яА-ЯёЁ]+$/u',
            'phone' => 'required|regex:/^\+7\d{10}$/',
            'email' => 'required|email|unique:users',
            'login' => 'required|unique:users',
            'password' => 'required|min:8',
        ];
    }
}
