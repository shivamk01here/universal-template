@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen pt-6 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs and Title -->
        <div class="pb-8 border-b border-gray-200/60 mb-12">
            <nav aria-label="Breadcrumb" class="mb-6">
                <ol role="list" class="flex items-center space-x-2 text-sm text-gray-500">
                    <li><a href="{{ route('home') }}" class="hover:text-gray-700 transition-colors">Home</a></li>
                    <li><i class="fas fa-chevron-right text-xs text-gray-400"></i></li>
                    <li><a href="{{ route('items.index') }}" class="font-medium text-gray-700 hover:text-gray-900 transition-colors">Services & Products</a></li>
                    @if(isset($category))
                        <li><i class="fas fa-chevron-right text-xs text-gray-400"></i></li>
                        <li><span class="font-medium text-gray-900">{{ $category->name }}</span></li>
                    @endif
                </ol>
            </nav>
            
            <div class="flex items-start">
            
                <div>
                <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-gray-900">{{ $category->name ?? 'All Services & Products' }}</h1>
            <p class="mt-2 text-lg text-gray-500">{{ $category->description ?? 'Browse our complete collection of services and products.' }}</p>
               
            </div>
            </div>
        </div>

        <div class="lg:grid lg:grid-cols-12 lg:gap-x-8">
            <!-- Filters Sidebar -->
            <aside class="lg:col-span-3 mb-12 lg:mb-0">
                <div class="bg-white/70 backdrop-blur-sm rounded-xl shadow-sm border border-gray-200/50 p-6 sticky top-8">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-filter text-lg text-gray-600 mr-3"></i>
                        <h2 class="text-xl font-medium text-gray-900">Filters</h2>
                    </div>

                    <form method="GET" action="{{ url()->current() }}" class="space-y-8">
                        <!-- Search Filter -->
                        <div>
                            <h3 class="text-base font-medium text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-search text-gray-500 mr-2"></i>
                                Search
                            </h3>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Search by name..." 
                                   class="w-full px-4 py-3 text-base border border-gray-300/60 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-500/20 focus:border-gray-500/60 transition-all duration-200 bg-white/80">
                        </div>

                        <!-- Category Filter -->
                        <div class="pt-6 border-t border-gray-200/60">
                            <h3 class="text-base font-medium text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-tags text-gray-500 mr-2"></i>
                                Categories
                            </h3>
                            <ul class="space-y-3">
                                <li>
                                    <a href="{{ route('items.index') }}" 
                                       class="flex items-center p-3 rounded-lg transition-all duration-200 {{ !isset($category) ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                                        <i class="fas fa-th mr-3 {{ !isset($category) ? 'text-white' : 'text-gray-400' }}"></i>
                                        <span>All Categories</span>
                                        @if(!isset($category))
                                            <i class="fas fa-chevron-right ml-auto"></i>
                                        @endif
                                    </a>
                                </li>
                                @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('items.category', $cat->slug) }}" 
                                       class="flex items-center p-3 rounded-lg transition-all duration-200 {{ isset($category) && $category->id == $cat->id ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }}">
                                        <i class="fas fa-folder mr-3 {{ isset($category) && $category->id == $cat->id ? 'text-white' : 'text-gray-400' }}"></i>
                                        <span>{{ $cat->name }}</span>
                                        @if(isset($category) && $category->id == $cat->id)
                                            <i class="fas fa-chevron-right ml-auto"></i>
                                        @endif
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="pt-6 border-t border-gray-200/60">
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-gray-900 to-gray-800 hover:from-gray-800 hover:to-gray-700 text-white font-medium py-3 px-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
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
                <div class="bg-white/70 backdrop-blur-sm rounded-xl shadow-sm border border-gray-200/50 p-6 mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between space-y-4 sm:space-y-0">
                        <div class="flex items-center text-base text-gray-700">
                            <i class="fas fa-list-ul mr-2 text-gray-500"></i>
                            <span><strong>{{ count($items) }}</strong> results found</span>
                        </div>
                        <form method="GET" action="{{ url()->current() }}" class="flex items-center space-x-3">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <label for="sort" class="text-base font-medium text-gray-700 flex items-center">
                                <i class="fas fa-sort mr-2 text-gray-500"></i>
                                Sort by:
                            </label>
                            <select name="sort" 
                                    id="sort" 
                                    onchange="this.form.submit()" 
                                    class="px-4 py-2 border border-gray-300/60 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-500/20 focus:border-gray-500/60 transition-all duration-200 bg-white/80 text-base">
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
                        <article class="group bg-white/70 backdrop-blur-sm rounded-xl shadow-sm border border-gray-200/50 overflow-hidden hover:shadow-md hover:border-gray-300/60 transition-all duration-300">
                            <a href="{{ route('items.show', $item->slug) }}" class="block">
                                <!-- Fixed aspect ratio image container -->
                                <div class="aspect-w-4 aspect-h-3 bg-gradient-to-br from-gray-100 to-gray-50 overflow-hidden">
                                    <img src="{{ $item->primary_image ?? 'https://placehold.co/400x300' }}" 
                                         alt="{{ $item->name }}" 
                                         class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                                </div>
                                
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100/80 text-gray-700">
                                            <i class="fas fa-tag mr-1 text-gray-400"></i>
                                            {{ $item->category_name }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="text-lg font-medium text-gray-900 group-hover:text-gray-700 transition-colors duration-200 mb-3 line-clamp-2">
                                        {{ $item->name }}
                                    </h3>
                                    
                                    <div class="flex items-center justify-between">
                                        <p class="text-xl font-medium text-gray-900">₹{{ number_format($item->base_price, 2) }}</p>
                                        <div class="flex items-center text-sm text-gray-500">
                                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-200"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @empty
                        <div class="col-span-full">
                            <div class="bg-white/70 backdrop-blur-sm rounded-xl shadow-sm border border-gray-200/50 text-center py-16 px-6">
                                <div class="max-w-md mx-auto">
                                    <i class="fas fa-search text-4xl text-gray-300 mb-6"></i>
                                    <h3 class="text-xl font-medium text-gray-900 mb-3">No items found</h3>
                                    <p class="text-gray-500 mb-8">No items match your current filters. Try adjusting your search criteria.</p>
                                    <a href="{{ route('items.index') }}" 
                                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-900 to-gray-800 hover:from-gray-800 hover:to-gray-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                                        <i class="fas fa-th-large mr-2"></i>
                                        View All Items
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                
            </div>
        </div>
    </div>
</div>
@endsection
