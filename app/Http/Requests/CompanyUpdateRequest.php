<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:companies,name,' . $this->route('company'),
            'address'=> 'required|string|max:255',
            'industry'=> 'required|string|max:255',
            'website'=> 'nullable|string|url|max:255',
            'owner_name'=> 'required|string|max:255',
            'owner_password'=> 'nullable|string|min:8|max:255',
            
        ];
        

    }
    public function messages(): array
    {
        return [
            'name.required' => 'The company name is required.',
            'name.string' => 'The company name must be a string.',
            'name.max' => 'The company name may not be greater than 255 characters.',
            'name.unique' => 'The company name has already been taken.',
            'address.required' => 'The company address is required',
            'address.max'=> 'The company address may not be greater than 255 characters.',
            'address.string'=> 'The company address must be in string',
            'industry.required' => 'The company industry is required',
            'industry.max'=> 'The company industry may not be greater than 255 characters.',
            'industry.string'=> 'The company industry must be in string',
            'website.url' => 'the company website must be valid URL',
            'website.max' => 'The company website must not be greater than 255 characters.',
            'website.string'=> 'The company website must be in string',

            'owner_name.required'=> 'The owner name is required.',
            'owner_name.max'=> 'The owner name must be less than 255 characters.',
            'owner_name.string'=> 'The owner name must be in string',
            'owner_password.max' => 'The owner password must be less than 255 characters.',
            'owner_password.min' => 'The owner password should be minimum 8 characters.',
        ];
    }
}
