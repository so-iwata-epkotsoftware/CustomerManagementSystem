<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisteredUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
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
