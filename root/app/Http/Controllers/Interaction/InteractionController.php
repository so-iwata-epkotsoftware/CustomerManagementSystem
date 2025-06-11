<?php

namespace App\Http\Controllers\Interaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Interactions\storeInteractionRequest;
use App\Http\Requests\Interactions\updateInteractionRequest;
use App\Models\Customer;
use App\Models\Interaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InteractionController extends Controller
{
    /**
     * 対応履歴一覧表示
     */
    public function index(String $id)
    {
        $interactions = Customer::where('id', $id)
                        ->select('id', 'name', 'email', 'phone', 'company_name', 'status')
                        ->with(['interactions' => function($query) {
                            $query->select('id','user_id', 'customer_id', 'content', 'created_at', 'status', 'supported_types')->latest('created_at')
                                ->with(['user' => function($query) {
                                    $query->select('id', 'name', 'email');
                                }]);
                        }])->paginate(10);

        return Inertia::render('Interactions/Index', [
            'interactions' => $interactions,
        ]);
    }

    /**
     * 対応履歴新規登録処理
     */
    public function store(storeInteractionRequest $request)
    {
        Interaction::create($request->validated());

        return to_route('interactions.index', $request->customer_id)->with([
            'message' => '登録完了',
            'status' => 'add',
        ]);
    }

    /**
     * 対応履歴更新処理
     */
    public function update(updateInteractionRequest $request, Interaction $interaction)
    {
        $interaction->update($request->validated());

        return to_route('interactions.index', $request->customer_id)->with([
            'message' => '更新完了',
            'status' => 'update',
        ]);
    }

    /**
     * 対応履歴削除処理
     */
    public function destroy(Request $request, Interaction $interaction)
    {
        $interaction->delete();

        return to_route('interactions.index', $request->customer_id)->with([
            'message' => '削除完了',
            'status' => 'delete',
        ]);
    }
}
