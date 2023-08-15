<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string',
            'username' => 'required|string|unique:users',
            'nik' => 'required|digits:16|unique:users',
            'unit_kerja' => 'required|string',
            'alamat' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
            'role' => ['required', Rule::in(User::$ROLE)],
        ];
    }
}
