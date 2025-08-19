@extends('layouts.app')

@section('content')
<div class="theme-gradient-primary min-h-screen pt-6 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs and Title -->
        <div class="pb-8 theme-border border-b mb-12">
            <nav aria-label="Breadcrumb" class="mb-6">
                <ol role="list" class="flex items-center space-x-2 text-sm theme-text-muted">
                    <li><a href="{{ route('home') }}" class="hover:theme-text-primary transition-colors">Home</a></li>
                    <li><i class="fas fa-chevron-right text-xs theme-text-muted/60"></i></li>
                    <li><a href="{{ route('items.index') }}" class="font-medium theme-text-secondary hover:theme-text-primary transition-colors">Services & Products</a></li>
                    @if(isset($category))
                        <li><i class="fas fa-chevron-right text-xs theme-text-muted/60"></i></li>
                        <li><span class="font-medium theme-text-primary">{{ $category->name }}</span></li>
                    @endif
                </ol>
            </nav>
            
            <div class="flex items-start">
                <div>
                    <h1 class="mt-4 text-4xl font-extrabold tracking-tight theme-text-primary">{{ $category->name ?? 'All Services & Products' }}</h1>
                    <p class="mt-2 text-lg theme-text-muted">{{ $category->description ?? 'Browse our complete collection of services and products.' }}</p>
                </div>
            </div>
        </div>

        <div class="lg:grid lg:grid-cols-12 lg:gap-x-8">
            <!-- Filters Sidebar -->
            <aside class="lg:col-span-3 mb-12 lg:mb-0">
                <div class="theme-bg-primary/90 backdrop-blur-sm rounded-xl shadow-sm theme-border border p-6 sticky top-8">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-filter text-lg theme-text-secondary mr-3"></i>
                        <h2 class="text-xl font-medium theme-text-primary">Filters</h2>
                    </div>

                    <form method="GET" action="{{ url()->current() }}" class="space-y-8">
                        <!-- Search Filter -->
                        <div>
                            <h3 class="text-base font-medium theme-text-primary mb-4 flex items-center">
                                <i class="fas fa-search theme-text-muted mr-2"></i>
                                Search
                            </h3>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Search by name..." 
                                   class="w-full px-4 py-3 text-base theme-border border rounded-lg shadow-sm focus:ring-2 focus:ring-primary-dynamic/20 focus:border-primary-dynamic/60 transition-all duration-200 theme-bg-primary/80 dark:bg-gray-900/80 theme-text-primary placeholder-theme-text-muted dark:placeholder-gray-400">
                        </div>

                        <!-- Category Filter -->
                        <div class="pt-6 theme-border border-t">
                            <h3 class="text-base font-medium theme-text-primary mb-4 flex items-center">
                                <i class="fas fa-tags theme-text-muted mr-2"></i>
                                Categories
                            </h3>
                            <ul class="space-y-3">
                                <li>
                                    <a href="{{ route('items.index') }}" 
                                       class="flex items-center p-3 rounded-lg transition-all duration-200 {{ !isset($category) ? 'bg-primary-dynamic text-white shadow-sm' : 'theme-text-secondary hover:theme-bg-tertiary/80 hover:theme-text-primary' }}">
                                        <i class="fas fa-th mr-3 {{ !isset($category) ? 'text-white' : 'theme-text-muted' }}"></i>
                                        <span>All Categories</span>
                                        @if(!isset($category))
                                            <i class="fas fa-chevron-right ml-auto"></i>
                                        @endif
                                    </a>
                                </li>
                                @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('items.category', $cat->slug) }}" 
                                       class="flex items-center p-3 rounded-lg transition-all duration-200 {{ isset($category) && $category->id == $cat->id ? 'bg-primary-dynamic text-white shadow-sm' : 'theme-text-secondary hover:theme-bg-tertiary/80 hover:theme-text-primary' }}">
                                        <i class="fas fa-folder mr-3 {{ isset($category) && $category->id == $cat->id ? 'text-white' : 'theme-text-muted' }}"></i>
                                        <span>{{ $cat->name }}</span>
                                        @if(isset($category) && $category->id == $cat->id)
                                            <i class="fas fa-chevron-right ml-auto"></i>
                                        @endif
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="pt-6 theme-border border-t">
                            <button type="submit" 
                                    class="w-full bg-button-dynamic hover:opacity-90 text-white font-medium py-3 px-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                                <i class="fas fa-search mr-2"></i>
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Product grid -->
            <div class="lg:col-span-9">
                <!-- Sorting and result count -->
                <div class="theme-bg-primary/90 backdrop-blur-sm rounded-xl shadow-sm theme-border border p-6 mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between space-y-4 sm:space-y-0">
                        <div class="flex items-center text-base theme-text-secondary">
                            <i class="fas fa-list-ul mr-2 theme-text-muted"></i>
                            <span><strong>{{ count($items) }}</strong> results found</span>
                        </div>
                        <form method="GET" action="{{ url()->current() }}" class="flex items-center space-x-3">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <label for="sort" class="text-base font-medium theme-text-secondary flex items-center">
                                <i class="fas fa-sort mr-2 theme-text-muted"></i>
                                Sort by:
                            </label>
                            <select name="sort" 
                                    id="sort" 
                                    onchange="this.form.submit()" 
                                    class="px-4 py-2 theme-border border rounded-lg shadow-sm focus:ring-2 focus:ring-primary-dynamic/20 focus:border-primary-dynamic/60 transition-all duration-200 theme-bg-primary/80 dark:bg-gray-900/80 theme-text-primary text-base">
                                <option value="latest" @if(request('sort') == 'latest') selected @endif>Latest</option>
                                <option value="price_asc" @if(request('sort') == 'price_asc') selected @endif>Price: Low to High</option>
                                <option value="price_desc" @if(request('sort') == 'price_desc') selected @endif>Price: High to Low</option>
                                <option value="name_asc" @if(request('sort') == 'name_asc') selected @endif>Name: A to Z</option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Item Grid -->
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 xl:grid-cols-3">
                    @forelse($items as $item)
                        <article class="group theme-bg-primary/80 backdrop-blur-sm rounded-xl shadow-sm theme-border border overflow-hidden hover:shadow-md hover:theme-border-light transition-all duration-300">
                            <a href="{{ route('items.show', $item->slug) }}" class="block">
                                <!-- Fixed aspect ratio image container -->
                                <div class="aspect-w-4 aspect-h-3 bg-gradient-to-br from-secondary-dynamic to-primary-dynamic overflow-hidden">
                                    <img src="{{ $item->primary_image ?? 'https://placehold.co/400x300' }}" 
                                        alt="{{ $item->name }}" 
                                        class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                                </div>
                                
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium theme-bg-tertiary/80 theme-text-secondary">
                                            <i class="fas fa-tag mr-1 theme-text-muted"></i>
                                            {{ $item->category_name }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="text-lg font-medium theme-text-primary group-hover:theme-text-secondary transition-colors duration-200 mb-3 line-clamp-2">
                                        {{ $item->name }}
                                    </h3>
                                    
                                    <div class="flex items-center justify-between">
                                        <p class="text-xl font-medium theme-text-primary">₹{{ number_format($item->base_price, 2) }}</p>
                                        <div class="flex items-center text-sm theme-text-muted">
                                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-200"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @empty
                        <div class="col-span-full">
                            <div class="theme-bg-primary/90 backdrop-blur-sm rounded-xl shadow-sm theme-border border text-center py-16 px-6">
                                <div class="max-w-md mx-auto">
                                    <i class="fas fa-search text-4xl theme-text-muted/70 mb-6"></i>
                                    <h3 class="text-xl font-medium theme-text-primary mb-3">No items found</h3>
                                    <p class="theme-text-muted mb-8">No items match your current filters. Try adjusting your search criteria.</p>
                                    <a href="{{ route('items.index') }}" 
                                       class="inline-flex items-center px-6 py-3 bg-button-dynamic hover:opacity-90 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                                        <i class="fas fa-th-large mr-2"></i>
                                        View All Items
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination (add as needed) -->
                {{-- <div class="mt-10">
                    @if(method_exists($items, 'links'))
                        {{ $items->links('vendor.pagination.tailwind') }}
                    @endif
                </div> --}}
            </div>
        </div>
    </div>
</div>
<style>
.theme-gradient-primary {
    background: linear-gradient(to bottom, var(--theme-tertiary, #f9fafb), var(--theme-primary, #fff));
}
[data-theme="dark"] .theme-gradient-primary {
    background: linear-gradient(to bottom, var(--theme-secondary, #1f2937), var(--theme-tertiary, #111827));
}
</style>
@endsection
