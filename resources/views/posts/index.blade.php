@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <h1 class="text-2xl font-bold mb-6">Blog Posts</h1>

        @if(count($posts) > 0)
            <div class="space-y-6">
                @foreach($posts as $post)
                    <div class="border-b pb-4">
                        <h2 class="text-xl font-semibold">
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-800">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="text-gray-500 text-sm">
                            By {{ $post->user->name }} | {{ $post->created_at->format('M d, Y') }}
                        </p>
                        <div class="mt-2">
                            {{ Str::limit($post->content, 150) }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @else
            <p>No posts yet. Be the first to create one!</p>
        @endif

        @auth
            <div class="mt-6">
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition">
                    Create New Post
                </a>
            </div>
        @endauth
    </div>
</div>
@endsection
