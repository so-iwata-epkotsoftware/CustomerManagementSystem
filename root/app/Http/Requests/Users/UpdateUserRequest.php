<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required','string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user),],
            'role' => ['required', 'in:admin,staff'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function attributes()
    {
        return [
            'name' => '氏名',
            'email' => 'メールアドレス',
            'role' => '権限',
            'password' => 'パスワード',
            'password_confirmation' => 'パスワード（確認）',
        ];
    }
}
