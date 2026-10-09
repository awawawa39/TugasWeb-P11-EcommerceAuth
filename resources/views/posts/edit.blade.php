<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Post</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('posts.update', $post) }}"
                  class="bg-white p-6 shadow rounded">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}"
                           class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Konten</label>
                    <textarea name="content" rows="6"
                              class="w-full border rounded p-2" required>{{ old('content', $post->content) }}</textarea>
                </div>

                <button class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>