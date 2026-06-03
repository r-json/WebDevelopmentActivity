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
        // Fetch statuses ordered by order_by for the dropdown
        $statuses = DB::table('statuses')->orderBy('order_by')->get();

        // Left join posts with statuses to get status display name
        $posts = DB::table('posts')
            ->leftJoin('statuses', 'posts.status_id', '=', 'statuses.id')
            ->select(
                'posts.*',
                'statuses.name as status_name',
                'statuses.display_name as status_display_name'
            )
            ->orderBy('posts.created_at', 'desc')
            ->get();

        return view('post', compact('posts', 'statuses'));
    }

    /**
     * Handle the form submission and log the data.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'status' => ['required', 'exists:statuses,id'],
        ], [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'status.required' => 'Please select a status.',
            'status.exists' => 'The selected status is invalid.',
        ]);

        // Look up the status name for backward compatibility
        $statusRow = DB::table('statuses')->where('id', $request->status)->first();

        Log::info('Post Submitted');
        Log::info('Title: ' . $request->title);
        Log::info('Description: ' . $request->description);
        Log::info('Status: ' . ($statusRow->display_name ?? 'N/A'));

        DB::table('posts')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => 'Guest',
            'status' => $statusRow->name ?? 'draft',
            'status_id' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/post')->with('success', 'Post submitted successfully and saved to database!');
    }

    /**
     * Show the edit form for a specific post.
     */
    public function edit($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        if (!$post) {
            return redirect('/post')->with('error', 'Post not found.');
        }

        $statuses = DB::table('statuses')->orderBy('order_by')->get();

        $posts = DB::table('posts')
            ->leftJoin('statuses', 'posts.status_id', '=', 'statuses.id')
            ->select(
                'posts.*',
                'statuses.name as status_name',
                'statuses.display_name as status_display_name'
            )
            ->orderBy('posts.created_at', 'desc')
            ->get();

        return view('post', compact('posts', 'statuses', 'post'));
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'status' => ['required', 'exists:statuses,id'],
        ], [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'status.required' => 'Please select a status.',
            'status.exists' => 'The selected status is invalid.',
        ]);

        $statusRow = DB::table('statuses')->where('id', $request->status)->first();

        DB::table('posts')->where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $statusRow->name ?? 'draft',
            'status_id' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect('/post')->with('success', 'Post updated successfully!');
    }
}
