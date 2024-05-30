<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    // Display a listing of the posts.
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Show the form for creating a new post.
    public function create()
    {
        return view('posts.create');
    }

    // Store a newly created post in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $request->user()->posts()->create($request->all());

        return redirect()->route('posts.index');
    }

    // Display the specified post.
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Show the form for editing the specified post.
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    // Update the specified post in storage.
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index');
    }

    // Remove the specified post from storage.
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index');
    }

    // Admin can remove any post from storage.
    public function adminDestroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
