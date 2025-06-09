<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        $customer = $this->route('customer');
        
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', Rule::unique('customers', 'email')->ignore($customer),],
            'phone' => ['nullable', 'string', Rule::unique('customers', 'phone')->ignore($customer),],
            'company_name' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:prospected,corresponding,completed'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => '顧客名',
            'email' => 'メールアドレス',
            'phone' => '電話番号',
            'company_name' => '会社名',
            'status' => 'ステータス',
        ];
    }
}
