<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Spatie\LaravelIgnition;

class PostController extends Controller
{
    public function index() {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(6)->withQueryString()
        ]);
    }

    public function show(Post $post) {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {
        $attributes = request()->validate([
            'title' => ['required'],
            'thumbnail' => ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => ['required'],
            'body' => ['required'],
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        auth()->user()->posts()->create($attributes);

        return redirect('/');
    }

    /* protected function getPosts() {
        $posts = Post::latest();

        if(request('search')) {
            $posts->where('title', 'like', '%' . request('search') . '%')
                  ->orWhere('body', 'like', '%' . request('search') . '%');
        }

        return $posts->get();
    } */
}
