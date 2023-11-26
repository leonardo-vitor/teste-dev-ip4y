<?php

namespace App\Http\Requests;

use App\Rules\Cpf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRegisterRequest extends FormRequest
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
//        dd($this->register);

        return [
            'name' => 'required',
            'last_name' => ['required'],
            'document' => ['required', new Cpf, Rule::unique('registers', 'document')->ignore($this->register), 'min:11', 'max:14'],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'email' => ['required', 'email'],
            'gender' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'document.required' => 'O campo CPF é obrigatório.',
            'document.unique' => 'O CPF informado já está cadastrado.'
        ];
    }
}
