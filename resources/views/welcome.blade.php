@extends('layouts.app')

@section('title', 'Homepage')

@push('meta')
    <meta name="description" content="Welcome to our homepage">
    <meta name="keywords" content="homepage, services, about">
@endpush

@push('styles')
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Simple smooth scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>
@endpush

@section('content')
    <!-- Header -->
    @if(isset($headerConfig))
        @include('partials.header', ['config' => $headerConfig])
    @endif

    <!-- Main Content: Dynamic Sections -->
    @if(isset($sections) && count($sections) > 0)
        @foreach ($sections as $section)
            @if($section->is_visible)
                {{-- Dynamically include the blade partial for the section --}}
                {{-- The view path is constructed from section_slug and template_id --}}
                @includeif('sections.' . $section->section_slug . '.' . $section->template_id, [
                    'content' => $section->content,
                    'testimonials' => $testimonials ?? [],
                    'faqs' => $faqs ?? [],
                    'blogs' => $blogs ?? []
                ])
            @endif
        @endforeach
    @else
        <div class="min-h-screen flex items-center justify-center bg-gray-50">
            <div class="text-center py-20">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-semibold text-gray-900 mb-2">Welcome!</h1>
                <p class="text-gray-600 max-w-md mx-auto">No sections have been configured for the homepage yet. Please check back later.</p>
            </div>
        </div>
    @endif

    <!-- Footer -->
    @if(isset($footerConfig))
        @include('partials.footer', ['config' => $footerConfig])
    @endif
@endsection

@push('scripts')
    <!-- Add any page-specific JavaScript here -->
    <script>
        // Smooth scroll for anchor links
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
@endpush
