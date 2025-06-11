<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class getUserController extends Controller
{
    public function index()
    {
        return response()->json([
            'users' => User::select('id', 'name', 'role', 'email')->get()
        ]);
    }
}
