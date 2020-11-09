<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function all()
    {
        return view('landing', [
            'posts' => Post::latest()->paginate(5)
        ]);
    }

    public function single(Post $post)
    {
        return view('single', compact('post'));
    }

    public function index()
    {
        return PostResource::collection(Post::latest()->paginate(5));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
        ]);

        $post = new Post;

        if ($request->hasFile('image')) {
            $imagePath = request('image')->store('/uploads/posts', 'public');
            $post->image = $imagePath;
        }

        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return new PostResource($post);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $post->update($request->only(['title', 'body', 'image']));

        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, 204);
    }
}
