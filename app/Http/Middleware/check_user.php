<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class check_user
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
            if (auth()->user()->status == 0) {
                return $next($request);
            }else{
                return redirect()->route('admin')->with(['not_allow'=>"คุณไม่ใช่ user"]);
            }
        }else{
            return redirect('/')->with(['not_allow'=>"กรุณาสมัครสมาชิกก่อนเข้าสู่ระบบ"]);
        }

    }
}
