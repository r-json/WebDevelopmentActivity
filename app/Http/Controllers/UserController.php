<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserPage()
    {
        $users = DB::table('users')->get();
        return view('user', compact('users'));
    }
    public function UserEditPage($id)
    {
        return ("<h1>User Edit Page</h1>");
    }
    public function UserAddPage()
    {
        return ("<h1>User Add Page</h1>");
    }
    public function UserDeletePage($id)
    {
        return ("<h1>User Delete Page</h1>");
    }
    public function userSubmit(Request $request)
    {
        $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required', 'min:2'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'first_name.required' => 'Must Input Your First Name',
            'middle_name.required' => 'Must Input Your Middle Name',
            'last_name.required' => 'Must Input Your Last Name',
            'email.required' => 'Must Input Your Email Address',
            'password.required' => 'Must Input Your Password',
        ]);

        Log::info('First Name: ' . $request->first_name);
        Log::info('Middle Name: ' . $request->middle_name);
        Log::info('Last Name: ' . $request->last_name);
        Log::info('Email Address: ' . $request->email);
        Log::info('Password: ' . $request->password);

        DB::table('users')->insert([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Log::info('User Added Successfully');

        return redirect('/user')->with('success', 'User registered successfully!');
    }
}
