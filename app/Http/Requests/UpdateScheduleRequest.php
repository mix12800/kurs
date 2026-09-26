<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
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
            'doctor_id' => 'exists:users,id',
            'date' => 'date|after_or_equal:today',
            'start_time' => 'date_format:H:i',
            'end_time' => 'date_format:H:i',
            'interval' => 'regex:/^\d{2}$/',
        ];
    }
}
