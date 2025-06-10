<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\RegisteredUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;


class StaffUserController extends Controller
{
    /**
     * ユーザー一覧表示
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at', 'role')
                    ->with(['login_logs' => function($query) {
                        $query->select('user_id', 'created_at')->latest();
                    }])
                    ->paginate(10);

        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    /**
     * ユーザー登録処理
     */
    public function store(RegisteredUserRequest $request)
    {
        $createUser = $request->validated();

        User::create([
            'name' => $createUser['name'],
            'email' => $createUser['email'],
            'role' => $createUser['role'],
            'password' => Hash::make($createUser['password']),
        ]);

        return to_route('users.index')->with([
            'message' => '登録完了',
            'status' => 'add',
        ]);
    }

    /**
     * ユーザー更新処理
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $updateUser = $request->validated();

        $user->update([
            'name' => $updateUser['name'],
            'email' => $updateUser['email'],
            'role' => $updateUser['role'],
            'password' => Hash::make($updateUser['password']),
        ]);

        return to_route('users.index')->with([
            'message' => '更新完了',
            'status' => 'update',
        ]);
    }

    /**
     * ユーザー削除処理
     */
    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index')->with([
            'message' => '削除完了',
            'status' => 'delete',
        ]);
    }
}
