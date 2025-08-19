@extends('layouts.app')

@section('content')
<div class="theme-bg-primary py-12 sm:py-16 min-h-screen">
    <div class="max-w-3xl mx-auto px-2 sm:px-6 lg:px-8">

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
                    FAQs
                </li>
            </ol>
        </nav>

        <!-- Heading -->
        <div class="mb-12 sm:mb-14 text-center">
            <h2 class="text-3xl font-bold theme-text-primary">
                Frequently Asked Questions
            </h2>
            <p class="mt-3 text-lg theme-text-muted">
                Find answers to the most common questions below.
            </p>
        </div>

        <!-- FAQ Accordion (Alpine.js) -->
        <div class="space-y-5 sm:space-y-7" x-data="{ open: null }">
            @foreach($faqs as $index => $faq)
                <div 
                    class="theme-bg-secondary rounded-2xl theme-border border shadow-sm sm:shadow-md transition-all duration-200 w-full"
                    :class="{ 'ring-2 ring-primary-dynamic border-primary-dynamic': open === {{ $index }} }"
                >
                    <!-- Question -->
                    <button 
                        @click="open === {{ $index }} ? open = null : open = {{ $index }}" 
                        :aria-expanded="open === {{ $index }} ? 'true' : 'false'"
                        class="w-full flex justify-between items-center px-5 sm:px-7 py-5 sm:py-6 rounded-2xl text-left focus:outline-none group transition-all"
                    >
                        <span class="text-base sm:text-lg font-medium theme-text-primary group-hover:theme-text-secondary transition-colors">
                            {{ $faq->question }}
                        </span>
                        <svg :class="{ 'rotate-180': open === {{ $index }} }" 
                            class="w-6 h-6 text-primary-dynamic transition-transform duration-200 flex-shrink-0 ml-4"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Answer -->
                    <div 
                        x-show="open === {{ $index }}" 
                        x-collapse
                        class="px-5 sm:px-7 pb-5 sm:pb-6 pt-0 -mt-3 text-base theme-text-secondary prose max-w-none leading-relaxed border-t theme-border overflow-hidden"
                    >
                        {!! $faq->answer !!}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>
/* Subtle border ring color (light/dark) */
.ring-primary-dynamic { box-shadow: 0 0 0 2px var(--primary-color), 0 2px 8px 0 rgb(0 0 0 / 0.06); }
.dark .ring-primary-dynamic { box-shadow: 0 0 0 2px var(--primary-color), 0 2px 8px 0 rgb(0 0 0 / 0.20); }
[x-cloak] { display: none !important; }
</style>
@endsection
