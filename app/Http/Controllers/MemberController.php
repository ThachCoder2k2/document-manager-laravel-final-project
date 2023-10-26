<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Hash;
class MemberController extends Controller
{
    public function get_member()
    {
        // $users = User::all();
        $groups = UserGroup::all();
        $users = User::query()
    ->leftJoin('user_group', 'users.group_user', '=', 'user_group.id')->where('users.group_user', '>','0')
    ->select('users.*', 'user_group.name AS user_group_name')
    ->get();
        return view('users_list', ['users' => $users, 'groups' => $groups]);
    }

    public function add()
    {
        return view('addmember');
    }
    public function add_user(Request $request)
    {
        $role=0;
        if($request->role=='admin')
            $role = 1;
        else
            $role = 0;
        try {
            
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'role' => $role,
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->route('admin.users');
    }

    public function delete_user(Request $request)
    {
        //dd($request);
        try {
            $user = User::find($request->id);
        } catch (\Throwable $th) {
            dd($th);
        }
        try {
            $user->delete();
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->route('admin.users');
    }

    public function edit_user(Request $request)
     {
        //dd($request);
        try {
            $user = User::find($request->id);
        } catch (\Throwable $th) {
            dd($th);
        }
        $user->name = $request->name;
        //$user->email = $request->email;
        if($request->role=='admin')
            $user->role = 1;
        else
            $user->role = 0;
        try {
            $user->save();
        } catch (\Throwable $th) {
                dd($th);
        }

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
     }
    
     public function add_group(Request $request)
    {
        try {
            
            UserGroup::create();
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->route('admin.users');
    }
}
