<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = getRouteId($this, 'user');

        $rules = [
            "name" => ['required', 'string', 'min:3', 'max:190', 'regex:/^[\p{Arabic}A-Za-z _-]+$/u'],
            "mobile" => ['required', 'numeric', 'regex:/^[0-9]{10,20}$/', 'unique:users,mobile,'.$id],
            "email" => ['required', 'email', 'unique:users,email,'.$id],
            'password' => ['required', 'string', 'min:3', 'max:190'],
            "birth_date" => ['nullable', 'date_format:Y-m-d'],
            
            "addresses" => ['required', 'array'],
            "addresses.address_name" => ['required', 'array', 'min:1'],
            "addresses.address_name.*" => ['required', 'string', 'min:3', 'max:190', 'regex:/^[\p{Arabic}A-Za-z _-]+$/u'],
            
            "addresses.address" => ['required', 'array', 'min:1'],
            "addresses.address.*" => ['required', 'string', 'min:3', 'max:190'],

            "addresses.address_mobile" => ['nullable', 'array', 'min:1'],
            "addresses.address_mobile.*" => ['nullable', 'numeric', 'regex:/^[0-9]{10,20}$/'],
        ];

        if ($this->routeIs('users.update')) {
            $rules['password'][0] = 'nullable';
        }

        return $rules;
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        if (!empty($this->password)) {
            $this->merge([
                'password' => bcrypt($this->password)
            ]);
        }
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated()
    {
        if (!empty($this->password)) {
            return array_merge($this->validator->validated(), ['password' => $this->password]);
        }

        return $this->validator->validated();
    }
}
