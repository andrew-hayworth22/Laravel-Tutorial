<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index() {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create() {
        return view('admin.posts.create');
    }

    public function store() {
        $attributes = $this->validatePost();

        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        auth()->user()->posts()->create($attributes);

        return redirect('/');
    }

    public function edit(Post $post) {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post) {
        $attributes = $this->validatePost($post);

        if($attributes['thumbnail'] ?? false)
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        $post->update($attributes);

        return back()->with('success', 'Post updated!');
    }

    public function destroy(Post $post) {
        $post->delete();
        return back()->with('success', 'Post deleted!');
    }

    /* protected function getPosts() {
        $posts = Post::latest();

        if(request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%')
                  ->orWhere('body', 'like', '%' . request('search') . '%');
        }

        return $posts->get();
    } */

    /**
     * @param Post $post
     * @return array
     */
    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();
        $attributes = request()->validate([
            'title' => ['required'],
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'excerpt' => ['required'],
            'body' => ['required'],
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
        return $attributes;
    }
}
