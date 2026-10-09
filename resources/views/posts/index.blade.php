<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Post</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('posts.create') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                    + Buat Post
                </a>

                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border p-2">Judul</th>
                            <th class="border p-2">Author</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                        <tr>
                            <td class="border p-2">{{ $post->title }}</td>
                            <td class="border p-2">{{ $post->user->name }}</td>
                            <td class="border p-2">
                                <a href="{{ route('posts.show', $post) }}" class="text-blue-500">Lihat</a>
                                @can('update', $post)
                                    | <a href="{{ route('posts.edit', $post) }}" class="text-yellow-600">Edit</a>
                                @endcan
                                @can('delete', $post)
                                    | <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                           class="inline" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500">Hapus</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="border p-4 text-center text-gray-500">
                                Belum ada post.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $posts->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>