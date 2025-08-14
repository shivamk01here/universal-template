@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    @if(isset($pageSections['hero']))
        @include('frontend.partials._hero_section', ['section' => $pageSections['hero']])
    @endif

    <!-- Featured Services Section -->
    @if(isset($featuredServices) && count($featuredServices) > 0)
    <div class="py-20 bg-gradient-to-br from-slate-50 to-blue-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-slate-900 tracking-tight">Featured Services</h2>
                <p class="mt-4 text-xl text-slate-600 max-w-2xl mx-auto">Discover our premium services crafted for excellence</p>
                <div class="w-24 h-1 bg-gradient-to-r from-slate-600 to-slate-800 mx-auto mt-6 rounded-full"></div>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($featuredServices as $item)
                    @include('frontend.partials._item_card', ['item' => $item, 'short' => true])
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Featured Products Section -->
    @if(isset($featuredProducts) && count($featuredProducts) > 0)
    <div class="py-20 bg-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-slate-50/30 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-slate-900 tracking-tight">Featured Products</h2>
                <p class="mt-4 text-xl text-slate-600 max-w-2xl mx-auto">Handpicked products that define quality and innovation</p>
                <div class="w-24 h-1 bg-gradient-to-r from-slate-600 to-slate-800 mx-auto mt-6 rounded-full"></div>
            </div>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($featuredProducts as $item)
                    @include('frontend.partials._item_card', ['item' => $item, 'short' => true])
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- How It Works Section -->
    @if(isset($pageSections['how-it-works']))
        @include('frontend.partials._how_it_works_section', ['section' => $pageSections['how-it-works']])
    @endif

    <!-- Testimonials Section -->
    @if(isset($testimonials) && count($testimonials) > 0)
        @include('frontend.partials._testimonials_section', ['testimonials' => $testimonials])
    @endif

    @if(isset($blogs) && count($blogs) > 0)
        @include('frontend.partials._blogs', ['blogs' => $blogs])
    @endif

    <!-- FAQ Section -->
    @if(isset($faqs) && count($faqs) > 0)
    <div class="py-20 bg-gradient-to-br from-slate-50 to-slate-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-slate-900 tracking-tight">Frequently Asked Questions</h2>
                    <p class="mt-4 text-xl text-slate-600">Everything you need to know about our services</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-slate-600 to-slate-800 mx-auto mt-6 rounded-full"></div>
                </div>
                
                <div class="space-y-4">
                    @foreach($faqs as $faq)
                    <div x-data="{ open: false }" 
                        class="group bg-white/70 backdrop-blur-sm border border-white/20 rounded-2xl shadow-sm hover:shadow-xl hover:shadow-slate-200/20 transition-all duration-300 hover:border-slate-200/50">
                        <button 
                            @click="open = !open" 
                            class="w-full flex justify-between items-center px-6 py-5 text-left focus:outline-none focus:ring-2 focus:ring-slate-500/20 rounded-2xl"
                        >
                            <span class="text-lg font-semibold text-slate-900 group-hover:text-slate-700 transition-colors">{{ $faq->question }}</span>
                            <div class="flex-shrink-0 ml-4">
                                <div class="w-8 h-8 bg-gradient-to-r from-slate-600 to-slate-800 rounded-full flex items-center justify-center transform transition-all duration-200 group-hover:scale-110" 
                                    :class="{ 'rotate-180': open }">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </button>
                        <div 
                            x-show="open" 
                            x-transition:enter="transition ease-out duration-300" 
                            x-transition:enter-start="opacity-0 max-h-0" 
                            x-transition:enter-end="opacity-100 max-h-96"
                            x-transition:leave="transition ease-in duration-200" 
                            x-transition:leave-start="opacity-100 max-h-96" 
                            x-transition:leave-end="opacity-0 max-h-0"
                            x-cloak
                            class="overflow-hidden"
                        >
                            <div class="px-6 pb-6 text-slate-700 leading-relaxed border-t border-slate-100/50 pt-4">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-12">
                    <a href="{{ route('faq.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-slate-600 to-slate-800 text-white font-semibold rounded-xl hover:from-slate-700 hover:to-slate-900 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <span>View All FAQs</span>
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Enhanced Newsletter Section -->
    <div class="py-20 bg-gradient-to-br from-slate-800 via-slate-900 to-slate-800 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-grid-slate-700/25 [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))]"></div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-10 left-10 w-32 h-32 bg-slate-700/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-40 h-40 bg-slate-600/20 rounded-full blur-3xl"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Stay Updated</h2>
                <p class="text-xl text-slate-300 mb-8 max-w-2xl mx-auto">
                    Get the latest updates on services, exclusive offers, and expert tips delivered to your inbox.
                </p>
                
                <div class="max-w-md mx-auto">
                    <form class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input type="email" 
                                   placeholder="Enter your email" 
                                   class="w-full px-6 py-4 bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl text-white placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent transition-all duration-200">
                        </div>
                        <button type="submit" 
                                class="px-8 py-4 bg-white text-slate-900 font-semibold rounded-2xl hover:bg-slate-100 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl whitespace-nowrap">
                            Subscribe
                        </button>
                    </form>
                    
                    <p class="text-sm text-slate-400 mt-4">
                        No spam, unsubscribe anytime. We respect your privacy.
                    </p>
                </div>
                
                <!-- Trust indicators -->
                <div class="mt-12 flex justify-center items-center space-x-8 text-slate-400">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm">Secure</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        <span class="text-sm">10K+ Subscribers</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="text-sm">Weekly Tips</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<style>
/* Enhanced CSS for premium effects */
.group:hover .transform { transform: translateY(-2px); }
[x-cloak] { display: none !important; }
.backdrop-blur-sm { backdrop-filter: blur(4px); }

/* Grid pattern for newsletter */
.bg-grid-slate-700\/25 {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32' fill='none' stroke='rgb(71 85 105 / 0.15)'%3e%3cpath d='m0 .5 32 0M.5 0v32'/%3e%3c/svg%3e");
}
</style>