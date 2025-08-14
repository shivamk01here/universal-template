<!-- Your existing card with premium styling -->
<div class="group relative flex flex-col rounded-2xl border border-gray-100 overflow-hidden bg-white shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
    <div class="relative h-48 bg-gradient-to-br from-gray-50 to-gray-100 rounded-t-2xl overflow-hidden">
        <img src="{{ $item->primary_image ?? 'https://placehold.co/400x300' }}" alt="{{ $item->name }}" class="w-full h-full object-center object-cover transition-transform duration-300 group-hover:scale-105">
        @if(isset($item->avg_rating) && $item->avg_rating > 4.5)
            <span class="absolute top-2 left-2 bg-white/90 backdrop-blur-sm text-amber-700 text-xs font-medium px-2 py-1 rounded-full border border-amber-200 shadow-sm">
                <i class="fas fa-crown text-amber-500 mr-1"></i>
                Top Rated
            </span>
        @endif
    </div>
    <div class="p-4 flex flex-col flex-grow">
        <p class="text-xs font-medium uppercase tracking-wide text-slate-500 mb-1">{{ $item->item_type }}</p>
        <h3 class="text-lg font-semibold text-slate-800 mb-2 leading-tight h-12 overflow-hidden">
            <a href="{{ route('items.show', $item->slug) }}" class="hover:text-slate-600 transition-colors duration-200">
                <span aria-hidden="true" class="absolute inset-0"></span>
                {{ Str::limit($item->name, 50) }}
            </a>
        </h3>
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                @if(isset($item->avg_rating))
                    <i class="fas fa-star text-amber-400"></i>
                    <span class="ml-1 text-sm font-medium text-slate-600">{{ number_format($item->avg_rating, 1) }}</span>
                @else
                    <span class="text-xs font-medium text-slate-500 bg-slate-50 px-2 py-1 rounded-full">New</span>
                @endif
            </div>
            <p class="text-xl font-bold text-slate-900">₹{{ number_format($item->base_price, 2) }}</p>
        </div>
    </div>
</div>