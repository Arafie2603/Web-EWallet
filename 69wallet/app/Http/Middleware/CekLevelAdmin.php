<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLevelAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $level = $request->session()->get("role_user");
        try {
            if ($level == 1) {
                return redirect()->intended('admin.dashboard');
            } else if ($level == 0) {
                return redirect()->intended('dashboard_user');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf akses anda ditolak');
        }
        return $next($request);
    }
}
