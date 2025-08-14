<!-- resources/views/frontend/blogs/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white pt-8 pb-20 px-4 sm:px-6 lg:pt-12 lg:pb-28 lg:px-8">
    <div class="relative max-w-lg mx-auto lg:max-w-7xl">

        <!-- Breadcrumb -->
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li>
                    <a href="{{ url('/') }}" class="hover:text-indigo-600">Home</a>
                </li>
                <li>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li class="text-gray-700 font-medium">
                    Blog
                </li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="text-center">
            <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl">
                ✨ From the Blog
            </h2>
            <p class="mt-3 text-lg text-gray-500 max-w-2xl mx-auto">
                Fresh thoughts, ideas, and guides to inspire your journey.
            </p>
        </div>

        <!-- Blog Grid -->
        <div class="mt-12 grid gap-12 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($blogs as $blog)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 flex flex-col">
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="group relative block overflow-hidden">
                        <img class="w-full h-56 object-cover transform group-hover:scale-105 transition duration-300"
                             src="{{ $blog->image_url ?? 'https://placehold.co/800x400' }}" 
                             alt="{{ $blog->title }}">
                    </a>

                    <div class="flex-1 p-5 flex flex-col">
                        <a href="{{ route('blogs.show', $blog->slug) }}">
                            <h3 class="text-lg font-semibold text-gray-900 hover:text-indigo-600 transition duration-200">
                                {{ $blog->title }}
                            </h3>
                        </a>
                        <p class="mt-3 text-sm text-gray-500 flex-1">
                            {{ Str::limit(strip_tags($blog->content), 120) }}
                        </p>
                        <div class="mt-5">
                            <a href="{{ route('blogs.show', $blog->slug) }}" 
                               class="inline-block text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                                Read More →
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    No blog posts yet. Check back soon!
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
