<?php

namespace App\Http\Requests\Interactions;

use Illuminate\Foundation\Http\FormRequest;

class storeInteractionRequest extends FormRequest
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
            'customer_id'     => ['required', 'integer', 'exists:customers,id'],
            'content'         => ['required', 'string', 'max:10000'],
            'user_id'         => ['required', 'integer', 'exists:users,id'],
            'status'          => ['required', 'in:prospected,corresponding,completed'],
            'supported_types' => ['required', 'in:opposing,phone,email,other'],
        ];
    }

    public function attributes()
    {
        return [
            'content'     => '対応内容',
            'status' => 'ステータス',
            'supported_types' => '対応種別',
        ];
    }
}
