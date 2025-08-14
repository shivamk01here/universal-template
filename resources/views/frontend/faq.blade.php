@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-purple-50 via-white to-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li>
                    <a href="{{ url('/') }}" class="hover:text-purple-600">Home</a>
                </li>
                <li>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li class="text-gray-700 font-medium">
                    FAQs
                </li>
            </ol>
        </nav>

        <!-- Heading -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">
                Frequently Asked Questions
            </h2>
            <p class="mt-2 text-base text-gray-500">
                Find answers to the most common questions below.
            </p>
        </div>

        <!-- FAQ Accordion -->
        <div class="space-y-2" x-data="{ active: null }">
            @foreach($faqs as $index => $faq)
            <div 
                class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200"
                :class="{ 'ring-1 ring-purple-400': active === {{ $index }} }"
            >
                <!-- Question -->
                <button 
                    @click="active === {{ $index }} ? active = null : active = {{ $index }}" 
                    class="w-full flex justify-between items-center px-4 py-3 text-left focus:outline-none"
                >
                    <span class="text-base font-medium text-gray-900">
                        {{ $faq->question }}
                    </span>
                    <svg :class="{ 'rotate-180': active === {{ $index }} }" 
                         class="w-5 h-5 text-purple-500 transition-transform duration-200 flex-shrink-0" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Answer -->
                <div 
                    x-show="active === {{ $index }}" 
                    x-transition:enter="transition ease-out duration-200" 
                    x-transition:enter-start="opacity-0 transform -translate-y-1" 
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150" 
                    x-transition:leave-start="opacity-100 transform translate-y-0" 
                    x-transition:leave-end="opacity-0 transform -translate-y-1"
                    class="px-4 pb-3 text-gray-600 prose max-w-none text-sm leading-relaxed border-t border-gray-100"
                >
                    {!! $faq->answer !!}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
