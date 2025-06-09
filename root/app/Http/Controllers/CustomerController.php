<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * 顧客一覧画面＆検索・フィルター（未完）
     */
    public function index()
    {
        $result = DB::table('customers as c')
        ->join('interactions as i', 'i.customer_id', '=', 'c.id')
        ->join('users as u', 'i.user_id', '=', 'u.id')
        ->select(
            'c.id as customer_id',
            'c.name as customer_name',
            'c.updated_at as customer_updated_at',
            'i.content AS interaction_content',
            'u.id as user_id',
            'u.name as user_name'
        )
        ->get();

        $grouped = $result->groupBy('customer_id')
                    ->map(function ($items) {
                        return [
                            'customer_name' => $items->first()->customer_name,
                            'updated_at' => $items->max('customer_updated_at'),
                            'content' => $items->map(function($item) {
                                return [
                                    'content' => $item->interaction_content,
                                ];
                            }),
                            'users' => $items->map(function ($item) {
                                return [
                                    'user_id' => $item->user_id,
                                    'user_name' => $item->user_name,
                                ];
                            }),
                        ];
                    });

        return Inertia::render('Customers/Index', [
            'customers' => Customer::select('id', 'name', 'email', 'phone', 'company_name', 'status', 'updated_at')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
