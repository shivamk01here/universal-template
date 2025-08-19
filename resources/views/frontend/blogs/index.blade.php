@extends('layouts.app')

@section('content')
<div class="theme-bg-primary pt-8 pb-20 px-4 sm:px-6 lg:pt-12 lg:pb-28 lg:px-8">
    <div class="relative max-w-lg mx-auto lg:max-w-7xl">

        <!-- Breadcrumb -->
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm theme-text-muted">
                <li>
                    <a href="{{ url('/') }}" class="hover:theme-text-primary transition-colors">Home</a>
                </li>
                <li>
                    <svg class="w-4 h-4 theme-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li class="theme-text-primary font-medium">
                    Blog
                </li>
            </ol>
        </nav>

        <!-- Page Heading -->
        <div class="text-center">
            <h2 class="text-3xl tracking-tight font-extrabold theme-text-primary sm:text-4xl">
                ✨ From the Blog
            </h2>
            <p class="mt-3 text-lg theme-text-muted max-w-2xl mx-auto">
                Fresh thoughts, ideas, and guides to inspire your journey.
            </p>
        </div>

        <!-- Blog Grid -->
        <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($blogs as $blog)
                <div class="theme-bg-secondary rounded-xl theme-border border shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                    <a href="{{ route('blogs.show', $blog->slug) }}" class="group relative block overflow-hidden">
                        <img class="w-full h-56 object-cover transform group-hover:scale-105 transition-all duration-300"
                            src="{{ $blog->image ? asset('storage/blogs/' . $blog->image) : 'https://placehold.co/800x400' }}"
                            alt="{{ $blog->title }}">
                    </a>
                    <div class="flex-1 p-5 flex flex-col">
                        <a href="{{ route('blogs.show', $blog->slug) }}">
                            <h3 class="text-lg font-semibold theme-text-primary hover:theme-text-secondary transition-all">
                                {{ $blog->title }}
                            </h3>
                        </a>
                        <p class="mt-3 text-sm theme-text-muted flex-1 line-clamp-4">
                            {{ Str::limit(strip_tags($blog->content), 120) }}
                        </p>
                        <div class="mt-5">
                            <a href="{{ route('blogs.show', $blog->slug) }}" 
                                class="inline-flex items-center text-sm font-semibold theme-text-secondary hover:theme-text-primary transition-all">
                                Read More
                                <span class="ml-1 group-hover:translate-x-0.5 transition-transform duration-200">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center theme-text-muted">
                    No blog posts yet. Check back soon!
                </div>
            @endforelse
        </div>

    </div>
</div>
<style>
/* Responsive text clamp for blog summary */
.line-clamp-4 {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
/* Premium image hover shadow */
.theme-bg-secondary {
    background-color: var(--bg-secondary) !important;
}
@media (max-width: 1024px) {
    .mt-12.grid { gap: 2rem; }
}
</style>
@endsection
