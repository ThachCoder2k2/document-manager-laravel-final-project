<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    } 
    public function getAuthLogin()
    {
        return view('login');
    }
    public function postAuthLogin(Request $request)
    {
        //dd($request);
        $arr = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        //dd($arr);
        if(Auth::attempt($arr))
        {
            if(Auth::user()->role == 'admin')
            {
                //dd($arr);
                return redirect()->route('admin.users');
            }
            else
            if(Auth::user()->role == 'user')
            {
                return redirect()->route('user.GetFileData');
            }
        }
        else
        {
            return redirect()->back()->with('error','Username hoac password khong dung!');
        }
    }
}