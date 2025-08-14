<div class="relative bg-gradient-to-br from-slate-50 via-white to-blue-50/30 overflow-hidden">
    <!-- Subtle background pattern -->
    <div class="absolute inset-0 bg-grid-slate-100/25 [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))]"></div>
    
    <div class="max-w-7xl mx-auto relative">
        <div class="relative z-10 pb-12 bg-gradient-to-r from-white/95 via-white/80 to-transparent sm:pb-20 md:pb-24 lg:max-w-2xl lg:w-full lg:pb-32 xl:pb-40">
            <!-- Decorative SVG -->
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white/60 transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100"></polygon>
            </svg>

            <main class="mt-12 mx-auto max-w-7xl px-4 sm:mt-16 sm:px-6 md:mt-20 lg:mt-24 lg:px-8 xl:mt-32">
                <div class="sm:text-center lg:text-left">
                    <!-- Main heading with subtle styling -->
                    <h1 class="text-4xl tracking-tight font-bold text-slate-900 sm:text-5xl md:text-6xl leading-tight">
                        <span class="block xl:inline">{{ $section->title ?? 'Quality Services' }}</span>
                        <span class="block bg-gradient-to-r from-slate-600 to-slate-800 bg-clip-text text-transparent xl:inline">
                            {{ $section->subtitle ?? 'At Your Doorstep' }}
                        </span>
                    </h1>

                    <!-- Description with better typography -->
                    <p class="mt-4 text-lg text-slate-600 sm:mt-6 sm:text-xl sm:max-w-xl sm:mx-auto md:mt-6 lg:mx-0 leading-relaxed">
                        {{ $section->content['description'] ?? 'Find and book top-rated professionals for all your needs. From home cleaning to beauty services, we have you covered.' }}
                    </p>

                    <!-- CTA section -->
                    <div class="mt-8 sm:mt-10 sm:flex sm:justify-center lg:justify-start">
                        <div class="group">
                            <a href="{{ $section->content['button_link'] ?? route('items.index') }}" 
                               class="w-full inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-2xl text-white bg-gradient-to-r from-slate-700 to-slate-800 hover:from-slate-800 hover:to-slate-900 shadow-lg shadow-slate-800/25 hover:shadow-xl hover:shadow-slate-800/30 transform hover:scale-105 transition-all duration-300 md:py-4 md:text-lg md:px-12">
                                <span>{{ $section->content['button_text'] ?? 'Explore Now' }}</span>
                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                        
                        <!-- Optional secondary action -->
                        <div class="mt-3 sm:mt-0 sm:ml-4">
                            <a href="#services" class="w-full inline-flex items-center justify-center px-6 py-4 border-2 border-slate-200 text-base font-medium rounded-2xl text-slate-700 bg-white/80 backdrop-blur-sm hover:bg-white hover:border-slate-300 hover:text-slate-800 transition-all duration-200 md:py-4 md:text-lg md:px-8">
                                Learn More
                            </a>
                        </div>
                    </div>

                    <!-- Trust indicators -->
                    <div class="mt-8 flex items-center sm:justify-center lg:justify-start space-x-6 text-sm text-slate-500">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-amber-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span>4.9/5 Rating</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-emerald-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Verified Professionals</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                            </svg>
                            <span>Same Day Service</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Hero image with overlay -->
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
        <div class="relative h-56 w-full sm:h-72 md:h-96 lg:w-full lg:h-full">
            <img class="h-full w-full object-cover" 
                 src="{{ $section->image_url ?? 'https://images.unsplash.com/photo-1556740738-b6a63e27c4df?q=80&w=2070&auto=format&fit=crop' }}" 
                 alt="Hero Image">
            <!-- Subtle overlay -->
            <div class="absolute inset-0 bg-gradient-to-l from-transparent via-slate-900/5 to-slate-900/20 lg:bg-gradient-to-l lg:from-transparent lg:via-slate-900/10 lg:to-white/40"></div>
            
            <!-- Floating elements for visual interest -->
            <div class="absolute top-8 right-8 bg-white/90 backdrop-blur-sm rounded-2xl p-4 shadow-lg hidden lg:block">
                <div class="flex items-center space-x-2 text-sm">
                    <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-slate-700 font-medium">Live Support</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Minimal CSS for subtle grid pattern */
.bg-grid-slate-100\/25 {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32' fill='none' stroke='rgb(148 163 184 / 0.15)'%3e%3cpath d='m0 .5 32 0M.5 0v32'/%3e%3c/svg%3e");
}
</style>