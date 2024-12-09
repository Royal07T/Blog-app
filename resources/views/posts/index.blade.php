<!-- resources/views/posts/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>All Posts</h1>

    <!-- Display success message if available -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('posts.create') }}" class="mb-3 btn btn-primary">Create New Post</a>

    @if($posts->isEmpty())
        <p>No posts available. <a href="{{ route('posts.create') }}">Create a post</a>!</p>
    @else
        <ul>
            @foreach ($posts as $post)
                <li>
                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
