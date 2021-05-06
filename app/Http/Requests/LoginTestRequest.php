<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class LoginTestRequest extends FormRequest
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
            'name' => 'required|string',
            'surname' => 'required|string',
            'ais_id' => 'required|numeric',
            'exam_code' => 'required',
        ];
    }

    public function getValidatedData()
    {
        $sanitized = $this->validated();
        $sanitized['is_active'] = Student::WRITING;

        return $sanitized;
    }
}
