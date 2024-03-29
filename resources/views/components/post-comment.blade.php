@props(['comment'])

<x-panel class="bg-gray-50">
    <article class="flex space-x-4">
        <div class = "flex-shrink-0">
            <img src="https://i.pravatar.cc/60?u={{ $comment->user_id }}" class="rounded-xl">
        </div>

        <div>
            <header class="mb-4">
                <h3 class="font-bold">{{ $comment->author->username }}</h3>
                <p class="text-xs">
                    Posted <time>{{ $comment->created_at->diffForHumans() }}</time>
                </p>
            </header>

            <p>
                {{ $comment->body }}
            </p>
        </div>
    </article>
</x-panel>
