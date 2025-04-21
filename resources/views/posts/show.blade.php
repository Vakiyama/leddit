@extends('layouts.app')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
        <p class="text-gray-500 mb-6">
            By {{ $post->user->name }} | {{ $post->created_at->format('M d, Y') }}
        </p>

        <div class="prose max-w-none mb-6">
            {!! nl2br(e($post->content)) !!}
        </div>

        <div class="flex space-x-4">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition">
                Back to Posts
            </a>

            @can('update', $post)
                <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 disabled:opacity-25 transition">
                    Edit Post
                </a>
            @endcan

            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:ring ring-red-300 disabled:opacity-25 transition" onclick="return confirm('Are you sure you want to delete this post?')">
                        Delete Post
                    </button>
                </form>
            @endcan
        </div>
    </div>
</div>
@endsection
