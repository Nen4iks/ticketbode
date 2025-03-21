<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Проверяем, является ли пользователь администратором
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Если нет, перенаправляем на страницу с ошибкой или на главную
        return redirect('/')->with('error', 'You do not have admin access.');
    }
}


