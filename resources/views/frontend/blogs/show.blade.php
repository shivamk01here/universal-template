@extends('layouts.app')

@section('content')
<div class="theme-bg-primary py-16 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <article class="
            prose prose-lg sm:prose-xl theme-text-primary mx-auto
            prose-headings:font-bold prose-headings:theme-text-primary
            prose-img:rounded-xl prose-img:shadow-md
            prose-blockquote:theme-text-secondary prose-blockquote:border-l-4 prose-blockquote:pl-4 prose-blockquote:border-primary-dynamic
            prose-a:theme-text-secondary prose-a:font-semibold hover:prose-a:theme-text-primary
            dark:prose-invert
        ">
            <h1>{{ $blog->title }}</h1>
            <p class="text-sm theme-text-muted">{{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}</p>
            @if($blog->image)
                <img 
                    src="{{ $blog->image ? asset('storage/blogs/' . $blog->image) : 'https://placehold.co/800x400' }}"
                    alt="{{ $blog->title }}" class="w-full rounded-xl my-8 shadow-sm"
                >
            @endif
            {!! $blog->content !!}
        </article>
    </div>
</div>
<style>
/* Fine-tuning for prose style if needed */
.prose {
    color: var(--text-primary);
}
.dark .prose {
    color: var(--text-primary);
}
.prose-headings\:theme-text-primary h1,
.prose-headings\:theme-text-primary h2,
.prose-headings\:theme-text-primary h3,
.prose-headings\:theme-text-primary h4 {
    color: var(--text-primary) !important;
}
.prose-blockquote\:theme-text-secondary blockquote {
    color: var(--text-secondary) !important;
    border-left-color: var(--primary-color) !important;
}
.prose-a\:theme-text-secondary a {
    color: var(--text-secondary);
    font-weight: 500;
    transition: color .2s;
    text-decoration-color: var(--primary-color);
}
.prose-a\:theme-text-secondary a:hover {
    color: var(--text-primary);
    text-decoration: underline;
}
</style>
@endsection
