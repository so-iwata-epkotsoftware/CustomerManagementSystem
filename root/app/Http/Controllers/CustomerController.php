<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customers\StoreCustomerRequest;
use App\Http\Requests\Customers\UpdateCustomerRequest;
use App\Models\Customer;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * 顧客一覧画面＆検索・フィルター（未完）
     */
    public function index()
    {
        return Inertia::render('Customers/Index', [
            'customers' => Customer::select('id', 'name', 'email', 'phone', 'company_name', 'status', 'updated_at')->paginate(10)
        ]);
    }

    /**
     * 新規顧客登録処理
     */
    public function store(StoreCustomerRequest $request)
    {
        Customer::create($request->validated());

        return to_route('customers.index');
    }

    /**
     * 顧客更新処理
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return to_route('customers.index');
    }

    /**
     * 顧客削除処理.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return to_route('customers.index');
    }
}
