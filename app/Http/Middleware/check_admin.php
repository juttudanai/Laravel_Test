<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class check_admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset(auth()->user()->status)) {
            if (auth()->user()->status == 1) {
                return $next($request);
            }else{
                return redirect()->route('user')->with(['not_allow'=>"คุณไม่ใช่ผู้ดูแลระบบ"]);
            }
        }else{
            return redirect('/')->with(['not_allow'=>"กรุณาติดต่อผู้ดูแลระบบ"]);
        }

    }
}
