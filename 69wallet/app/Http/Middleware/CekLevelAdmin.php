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
        if (!$request->user()->isAdmin()) {
            if ($request->is('admin/dashboard*')) {
                // Jika pengguna bukan admin dan sedang di halaman admin dashboard, biarkan aksesnya ke sana
            }
            return $next($request);
            // Jika pengguna bukan admin, alihkan mereka ke dashboard admin
            return redirect()->route('dashboard.index');
        }
        // $level = $request->session()->get("role_id");
        // if ($level == 1) {
        //     return redirect()->intended('admin.dashboard');
        // } 
        // return $next($request);
    }
}
