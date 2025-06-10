<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    /**
     * 管理者かどうか判断
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role !== 'admin')
        {
            // abort(403, '管理者専用機能です。');
            return to_route('customers.index')->with([
            'message' => '管理者専用機能',
            'status' => 'error',
        ]);
        }
        return $next($request);
    }
}
