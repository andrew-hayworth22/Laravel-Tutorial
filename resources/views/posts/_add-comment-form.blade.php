@auth
    <form method="post" action="/posts/{{ $post->slug }}/comments">
        <x-panel>
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/40?u={{ auth()->id() }}" class="rounded-full">
                <h2 class="ml-4">Want to Participate?</h2>
            </header>

            <x-form.textarea name="body"/>

            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200" >
                <x-form.button>Post</x-form.button>
            </div>
        </x-panel>
    </form>
@else
    <p>
        <a href="/register" class="hover:underline">Register</a> or <a href="/login" class="hover:underline">Login</a> to leave a comment
    </p>
@endauth
