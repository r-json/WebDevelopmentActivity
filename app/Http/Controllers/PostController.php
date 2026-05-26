<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display the post form and table.
     */
    public function index()
    {
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();
        return view('post', compact('posts'));
    }
    
    /**
     * Handle the form submission and log the data.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
        ], [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
        ]);

        Log::info('Post Submitted');
        Log::info('Title: ' . $request->title);
        Log::info('Description: ' . $request->description);

        DB::table('posts')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => 'Guest', // default value for required field
            'status' => 'draft',     // default status
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/post')->with('success', 'Post submitted successfully and saved to database!');
    }
}
