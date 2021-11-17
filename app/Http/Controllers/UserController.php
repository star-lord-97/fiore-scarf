<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        return User::select('id', 'name', 'email', 'phone', 'address', 'city')->where('is_admin', '!=', 1)->get();
    }

    public function show()
    {
        return auth()->guard('api')->user();
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'min:11', 'max:11'],
            'address' => ['required', 'string', 'max:256'],
            'city' => ['required', 'string', 'max:256']
        ]);

        User::where('id', auth()->guard('api')->id())->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city
        ]);;

        return User::where('id', auth()->guard()->id())->first();
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
