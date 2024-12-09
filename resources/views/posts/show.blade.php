<!-- resources/views/posts/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>

    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
    </form>

    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to All Posts</a>
@endsection
