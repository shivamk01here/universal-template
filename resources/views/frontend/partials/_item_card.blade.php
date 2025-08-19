<div class="group relative flex flex-col rounded-2xl theme-border border overflow-hidden theme-bg-primary shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
    <div class="relative h-48 theme-bg-tertiary rounded-t-2xl overflow-hidden">
        <img src="{{ $item->primary_image ?? 'https://placehold.co/400x300' }}" 
             alt="{{ $item->name }}" 
             class="w-full h-full object-center object-cover transition-transform duration-300 group-hover:scale-105">
        @if(isset($item->avg_rating) && $item->avg_rating > 4.5)
            <span class="absolute top-3 left-3 theme-bg-primary/90 backdrop-blur-sm text-amber-700 text-xs font-medium px-3 py-1.5 rounded-full border border-amber-200/50 shadow-sm">
                <i class="fas fa-crown text-amber-500 mr-1"></i>
                Top Rated
            </span>
        @endif
        @if($item->item_type === 'product' && isset($item->discount_percentage) && $item->discount_percentage > 0)
            <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                -{{ $item->discount_percentage }}%
            </span>
        @endif
    </div>
    <div class="p-5 flex flex-col flex-grow">
        <p class="text-xs font-semibold uppercase tracking-wider text-primary-dynamic mb-2">{{ $item->item_type }}</p>
        <h3 class="text-lg font-semibold theme-text-primary mb-3 leading-tight h-12 overflow-hidden">
            <a href="{{ route('items.show', $item->slug) }}" class="hover:text-primary-dynamic transition-colors duration-200">
                <span aria-hidden="true" class="absolute inset-0"></span>
                {{ Str::limit($item->name, 50) }}
            </a>
        </h3>
        
        <div class="mt-auto">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                    @if(isset($item->avg_rating) && $item->avg_rating > 0)
                        <div class="flex items-center">
                            <i class="fas fa-star text-amber-400 text-sm"></i>
                            <span class="ml-1 text-sm font-medium theme-text-secondary">{{ number_format($item->avg_rating, 1) }}</span>
                            @if(isset($item->total_reviews) && $item->total_reviews > 0)
                                <span class="ml-1 text-xs theme-text-muted">({{ $item->total_reviews }})</span>
                            @endif
                        </div>
                    @else
                        <span class="text-xs font-medium theme-text-muted theme-bg-tertiary px-2 py-1 rounded-full">New</span>
                    @endif
                </div>
                <div class="text-right">
                    <p class="text-xl font-bold theme-text-primary">₹{{ number_format($item->base_price, 0) }}</p>
                    @if(isset($item->original_price) && $item->original_price > $item->base_price)
                        <p class="text-sm theme-text-muted line-through">₹{{ number_format($item->original_price, 0) }}</p>
                    @endif
                </div>
            </div>
            
            <button onclick="addToCart({{ $item->id }})" 
                    class="w-full bg-button-dynamic text-white font-semibold py-2.5 px-4 rounded-xl hover:opacity-90 transform hover:scale-[1.02] transition-all duration-200 text-sm">
                Add to Cart
            </button>
        </div>
    </div>
</div>