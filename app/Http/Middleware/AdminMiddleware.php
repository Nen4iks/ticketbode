<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Проверяем, является ли пользователь администратором
        if (Auth::user() && Auth::user()->isAdmin()) {
            return $next($request);
        }

        // Если не админ, перенаправляем на главную страницу
        return redirect('/');
    }
}

