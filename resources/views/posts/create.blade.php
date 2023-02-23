<x-layout>
    <section class="px-6 py-8">
        <x-panel class="max-w-md mx-auto">
            <form method="POST" action="/admin/posts">
                @csrf

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="title">
                    Title
                </label>

                <input class="border border-gray-400 p-2 w-full"
                       type="text"
                       name="title"
                       id = "title"
                       value="{{ old('title') }}"
                       required
                >

                @error('title')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700 mt-4" for="slug">
                    Slug
                </label>

                <input class="border border-gray-400 p-2 w-full"
                       type="text"
                       name="slug"
                       id = "slug"
                       value="{{ old('slug') }}"
                       required
                >

                @error('slug')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700 mt-4"
                       for="excerpt">
                    Excerpt
                </label>

                <textarea class="border border-gray-400 p-2 w-full"
                       name="excerpt"
                       id = "excerpt"
                       value="{{ old('excerpt') }}"
                       required
                ></textarea>

                @error('excerpt')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700 mt-4"
                       for="body">
                    Body
                </label>

                <textarea class="border border-gray-400 p-2 w-full"
                          name="body"
                          id = "body"
                          value="{{ old('body') }}"
                          required
                ></textarea>

                @error('body')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700 mt-4"
                       for="category_id">
                    Category
                </label>

                <select name="category_id"
                        id="category">
                    @foreach(\App\Models\Category::all() as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ ucwords($category->name) }}
                        </option>
                    @endforeach
                </select>

                @error('category')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

                <div class="mt-4">
                    <x-submit-button>Publish</x-submit-button>
                </div>
            </form>
        </x-panel>
    </section>
</x-layout>