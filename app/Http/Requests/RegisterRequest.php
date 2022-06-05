<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'attendance_date' => 'required',
            'attendance' => 'required|array',
            'attendance.*' => "required|array|exists:App\Models\Learner,id",
            'attendance.*.status_id' => "required|exists:App\Models\AttendanceStatus,id",
        ];
    }
}
