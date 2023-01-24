<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    // Use clockwork to replace this functionality!
    DB::listen(function($query) {
       logger($query->sql, $query->bindings);
    });

    $posts = Post::latest();

    if(request('search')) {
        $posts->where('title', 'like', '%' . request('search') . '%')
              ->orWhere('body', 'like', '%' . request('search') . '%');
    }

    return view('posts', [
        'posts' => $posts->get(),
        'categories' => Category::all()
    ]);
})->name('home'); */

Route::get('/', [PostController::class, 'index'])->name('home');


/* Route::get('posts/{post:slug}', function(Post $post) {

    // Find a post by its slug and pass it to a view called "post"
    return view('post', [
        'post' => $post
    ]);

}); // also whereAlpha(), whereAlphanumeric(), whereNumber() */

Route::get('posts/{post:slug}', [PostController::class, 'show']);

/* Route::get('categories/{category:slug}', function(Category $category) {
    // Find a post by its slug and pass it to a view called "post"
    return view('posts', [
        'posts' => $category->posts->load(['category', 'author']),
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);
})->name('category'); */

/* Route::get('authors/{author:username}', function(User $author) {
        // Find a post by its slug and pass it to a view called "post"
        return view('posts.index', [
            'posts' => $author->posts->load(['category', 'author'])
        ]);
   }); */