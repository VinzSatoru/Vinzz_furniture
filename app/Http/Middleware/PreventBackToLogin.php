<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventBackToLogin
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
        // Jika user sudah login dan mencoba mengakses halaman login/register
        if (Auth::check()) {
            $user = Auth::user();
            
            // Cek apakah request ke halaman login atau register
            if ($request->is('login') || $request->is('register')) {
                if ($user->isAdmin()) {
                    return redirect()->route('admin.dashboard')
                        ->with('info', 'Anda sudah login sebagai admin.');
                }
                
                return redirect()->route('home')
                    ->with('info', 'Anda sudah login.');
            }
        }

        return $next($request);
    }
} 