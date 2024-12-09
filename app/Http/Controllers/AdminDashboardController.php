<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // Display admin dashboard
    public function index()
    {
        $posts = Post::all();
        $users = User::all();
        $comments = Comment::all();

        return view('admin.dashboard', compact('posts', 'users', 'comments'));
    }

    // Manage posts (create, edit, delete)
    public function managePosts()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    // You can add methods for managing users and comments as well
}
