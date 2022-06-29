<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function showLoginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        DB::connection('mysql');
        $userData = DB::select("SELECT * FROM user WHERE user_name=?", [$request->UserName]);

        if (!isset($userData[0]->user_name)) {
            return view('login', ['err' => "使用不存在"]);
        } elseif (password_verify($request->PassWord, $userData[0]->password)) {

            session(['username' => $userData[0]->user_name]);
            return redirect('/');
        } else {

            return view('login', ['err' => "密碼錯誤"]);
        }
    }

    public function logout()
    {
        session()->forget('username');
        return redirect('/');
    }
}
