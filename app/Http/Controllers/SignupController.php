<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\User;
use Illuminate\Database\QueryException;

class SignupController extends Controller
{
    public function signup()
    {
        return view('signup');
    }
    public function postRegister(Request $request)
    {
        try {
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->route('login');
    }
}
