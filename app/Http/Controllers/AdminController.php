<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return User::select('id', 'name', 'email', 'phone', 'address', 'city')->where('is_admin', 1)->where('id', '!=', auth()->guard('api')->id())->get();
    }

    public function store(User $user)
    {
        $user->is_admin = 1;
        $user->save();
        return User::select('id', 'name', 'email', 'phone', 'address', 'city')->where('is_admin', 1)->where('id', '!=', auth()->guard('api')->id())->get();
    }

    public function destroy(User $user)
    {
        $user->is_admin = 0;
        $user->save();
        return User::select('id', 'name', 'email', 'phone', 'address', 'city')->where('is_admin', 1)->where('id', '!=', auth()->guard('api')->id())->get();
    }
}
