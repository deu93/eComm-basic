<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request) {
        $user = User::where(['email' => $request->email])->first();
        if(!$user || !Hash::check($request->password, $user->password)) {
            return "Username or password is not matched";
        }
        else {
            $request->session()->put('user', $user);
            return redirect()->route('home');
        }
    }

    
}
