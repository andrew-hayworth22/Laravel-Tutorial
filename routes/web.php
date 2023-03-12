<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionsController;
use App\Services\MailchimpNewsletter;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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
Route::post('posts/{post:slug}/comments', [CommentController::class, 'store']);

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

Route::get('register', [RegistrationController::class, 'create'])->middleware('guest');
Route::post('register', [RegistrationController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('sessions', [SessionsController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::post('newsletter', NewsletterController::class);

Route::middleware('can:admin')->group(function () {
    Route::resource('admin/posts', AdminPostController::class)->except('show');

    // Route::post('admin/posts', [AdminPostController::class, 'store']);
    // Route::get('admin/posts/create', [AdminPostController::class, 'create']);
    // Route::get('admin/posts', [AdminPostController::class, 'index']);
    // Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    // Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);
    // Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
});
