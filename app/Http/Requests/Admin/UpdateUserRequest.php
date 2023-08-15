<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('dashboard.admin.user.index');

        return [
            'nama' => 'sometimes|required|string',
            'username' => 'sometimes|required|unique:users,username,' . $userId,
            'password' => 'nullable|min:8',
            'nik' => 'sometimes|required|digits:16|unique:users,nik,' . $userId,
            'unitkerja' => 'sometimes|required|string',
            'alamat' => 'sometimes|required|string',
            'role' => Rule::in(User::$ROLE),
        ];
    }
}
