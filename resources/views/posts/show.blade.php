<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $post->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">
                <p class="text-sm text-gray-500 mb-4">Oleh: {{ $post->user->name }}</p>
                <div>{!! nl2br(e($post->content)) !!}</div>
                <a href="{{ route('posts.index') }}"
                   class="inline-block mt-6 text-blue-500">← Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>