<!-- resources/views/admin/dashboard.blade.php -->

<h1>Admin Dashboard</h1>

<h2>Posts</h2>
<a href="{{ route('admin.posts.manage') }}">Manage Posts</a>

<h2>Users</h2>
<ul>
    @foreach($users as $user)
        <li>{{ $user->name }}</li>
    @endforeach
</ul>

<h2>Comments</h2>
<ul>
    @foreach($comments as $comment)
        <li>{{ $comment->content }}</li>
    @endforeach
</ul>
