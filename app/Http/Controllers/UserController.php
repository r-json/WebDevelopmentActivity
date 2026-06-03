<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display the user registration form and user card list.
     */
    public function UserPage()
    {
        $userTypes = DB::table('user_types')->orderBy('order_by')->get();

        $users = DB::table('users')
            ->leftJoin('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select(
                'users.*',
                'user_types.name as user_type_name',
                'user_types.display_name as user_type_display_name'
            )
            ->orderBy('users.id', 'desc')
            ->get();

        return view('user', compact('users', 'userTypes'));
    }

    /**
     * Show the edit form for a specific user.
     */
    public function edit($id)
    {
        $editUser = DB::table('users')->where('id', $id)->first();

        if (!$editUser) {
            return redirect('/user')->with('error', 'User not found.');
        }

        $userTypes = DB::table('user_types')->orderBy('order_by')->get();

        $users = DB::table('users')
            ->leftJoin('user_types', 'users.user_type_id', '=', 'user_types.id')
            ->select(
                'users.*',
                'user_types.name as user_type_name',
                'user_types.display_name as user_type_display_name'
            )
            ->orderBy('users.id', 'desc')
            ->get();

        return view('user', compact('users', 'userTypes', 'editUser'));
    }

    /**
     * Update the specified user (excluding password).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required', 'min:2'],
            'email' => ['required', 'email'],
            'user_type' => ['required', 'exists:user_types,id'],
        ], [
            'first_name.required' => 'Must Input Your First Name',
            'middle_name.required' => 'Must Input Your Middle Name',
            'last_name.required' => 'Must Input Your Last Name',
            'email.required' => 'Must Input Your Email Address',
            'user_type.required' => 'Please select a user type.',
            'user_type.exists' => 'The selected user type is invalid.',
        ]);

        DB::table('users')->where('id', $id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'user_type_id' => $request->user_type,
            'updated_at' => now(),
        ]);

        Log::info('User Updated Successfully — ID: ' . $id);

        return redirect('/user')->with('success', 'User updated successfully!');
    }

    public function UserEditPage($id)
    {
        return redirect()->route('user.edit', $id);
    }

    public function UserAddPage()
    {
        return ("<h1>User Add Page</h1>");
    }

    public function UserDeletePage($id)
    {
        return ("<h1>User Delete Page</h1>");
    }

    /**
     * Handle the user registration form submission.
     */
    public function userSubmit(Request $request)
    {
        $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required', 'min:2'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'user_type' => ['required', 'exists:user_types,id'],
        ], [
            'first_name.required' => 'Must Input Your First Name',
            'middle_name.required' => 'Must Input Your Middle Name',
            'last_name.required' => 'Must Input Your Last Name',
            'email.required' => 'Must Input Your Email Address',
            'password.required' => 'Must Input Your Password',
            'user_type.required' => 'Please select a user type.',
            'user_type.exists' => 'The selected user type is invalid.',
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
            'password' => Hash::make($request->password),
            'user_type_id' => $request->user_type,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Log::info('User Added Successfully');

        return redirect('/user')->with('success', 'User registered successfully!');
    }
}
