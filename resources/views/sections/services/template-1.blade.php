<section id="services" style="{{ getBackgroundStyle($content) }}" class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">{{ $content->heading ?? 'Our Services' }}</h2>
            <p class="text-gray-600 mt-2">{{ $content->subheading ?? '' }}</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($services as $service)
            <div class="group bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg hover:border-gray-300 transition-all duration-300">
                <!-- Icon -->
                <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-lg mb-4 group-hover:bg-gray-900 transition-colors duration-300">
                    <i class="{{ $service->image_url }} text-xl text-gray-600 group-hover:text-white transition-colors duration-300"></i>
                </div>
                
                <!-- Content -->
                <div class="space-y-3">
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-gray-800 transition-colors">
                        {{ $service->name }}
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                        {{ $service->description }}
                    </p>
                </div>
                
                <!-- Link -->
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('items.show', $service->slug) }}" 
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors group/link">
                        <span>View Details</span>
                        <svg class="w-4 h-4 ml-1 transform group-hover/link:translate-x-1 transition-transform" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="lg:col-span-4 flex flex-col items-center justify-center py-12 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No services available</h3>
                <p class="text-gray-600 text-sm">Check back later for our services.</p>
            </div>
        @endforelse
        </div>
    </div>
</section>