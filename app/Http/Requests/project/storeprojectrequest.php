<?php

namespace App\Http\Requests\project;

use Illuminate\Foundation\Http\FormRequest;

class storeprojectrequest extends FormRequest
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
            'name' => 'required|string|min:4|max:100',
            'description' => 'nullable|string|min:50|max:200',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // Get all validation errors
        $errors = $validator->errors();

        // Construct a detailed error message
        $errorMessage = 'Validation failed for the following reasons:';
        foreach ($errors->all() as $error) {
            $errorMessage .= " - $error";
        }
    }

    /**
     * Perform any additional processing after validation passes.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $this->merge([
            'name' => trim($this->input('title'))

        ]);

    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'اسم المشروع',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'اسم المشروع مطلوب.',
        ];
    }
}