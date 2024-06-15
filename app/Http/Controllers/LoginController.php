<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login(Request $request){
        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            if (Auth()->user()->status == 1) {
                return response()->json(['login_success' => "admin"]);
            }else if (Auth()->user()->status == 0) {
                return response()->json(['login_success' => "user"]);
            }
        }else{
            return response()->json(['login_failed' => "ไม่มีข้อมูลในระบบ"]);
        }

    }
}
