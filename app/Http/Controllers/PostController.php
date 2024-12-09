<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display a listing of the posts.
    public function index()
    {
        // Get all posts
        $posts = Post::all();

        // Return the posts index view with the posts data
        return view('posts.index', compact('posts'));
    }

    // Show the form for creating a new post.
    public function create()
    {
        return view('posts.create');
    }

    // Store a newly created post in the database.
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create a new post
        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'], // Save the selected category
        ]);


        // Redirect to the posts index page after storing the post
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Display the specified post.
    public function show($id)
    {
        // Find the post by ID or fail if not found
        $post = Post::findOrFail($id);

        // Return the show view for the specific post
        return view('posts.show', compact('post'));
    }

    // Show the form for editing the specified post.
    public function edit($id)
    {
        // Find the post by ID or fail if not found
        $post = Post::findOrFail($id);

        // Return the edit view with the post data
        return view('posts.edit', compact('post'));
    }

    // Update the specified post in the database.
    public function update(Request $request, $id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Update the post with validated data
        $post->update($validated);

        // Redirect to the posts index page after updating the post
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // Remove the specified post from the database.
    public function destroy($id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Delete the post
        $post->delete();

        // Redirect to the posts index page after deleting the post
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
