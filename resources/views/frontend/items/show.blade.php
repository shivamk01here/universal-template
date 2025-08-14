@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen">
    <div class="pt-6 pb-20">
        <!-- Breadcrumb -->
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mb-6">
            <nav class="flex items-center space-x-2 text-sm text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-gray-700 transition-colors">Home</a>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                <a href="{{ route('items.index') }}" class="hover:text-gray-700 transition-colors">Items</a>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                <span class="text-gray-900 font-medium">{{ $item->name }}</span>
            </nav>
        </div>

        <!-- Main content -->
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:gap-x-16">

            <!-- Header Section -->
            <div class="pb-8 border-b border-gray-200/60 lg:col-span-2">
                <div class="flex items-start justify-between flex-wrap">
                    <div>
                        <h1 class="text-4xl font-light text-gray-900 tracking-tight">{{ $item->name }}</h1>
                        <p class="mt-3 text-sm text-gray-500 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                            Location Placeholder
                        </p>
                    </div>
                    <div class="flex items-center space-x-3 mt-4 md:mt-0">
                        <button class="p-3 rounded-full bg-white/80 backdrop-blur-sm shadow-sm border border-gray-200/50 text-gray-400 hover:text-rose-500 hover:bg-rose-50/50 transition-all duration-300" title="Add to Wishlist">
                            <i class="far fa-heart fa-lg"></i>
                        </button>
                        <button class="p-3 rounded-full bg-white/80 backdrop-blur-sm shadow-sm border border-gray-200/50 text-gray-400 hover:text-blue-500 hover:bg-blue-50/50 transition-all duration-300" title="Share">
                            <i class="fas fa-share-alt fa-lg"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Image gallery -->
            <div class="mt-8 lg:mt-0 flex justify-center">
                <div class="w-full max-w-md rounded-xl overflow-hidden shadow-lg bg-gradient-to-br from-gray-100 to-gray-50 ring-1 ring-gray-200/50">
                    <img src="{{ $item->images[0]->image_url ?? 'https://placehold.co/800x600' }}" alt="{{ $item->name }}" class="w-full h-auto object-contain">
                </div>
            </div>

            <!-- Item info -->
            <div class="mt-8 lg:mt-0 lg:pl-6">
                <div class="bg-white/70 backdrop-blur-sm rounded-xl shadow-sm border border-gray-200/50 p-8">
                    <h1 class="text-2xl font-light tracking-tight text-gray-900">{{ $item->name }}</h1>
                    <p class="text-3xl font-light text-gray-900 mt-6">₹{{ number_format($item->base_price, 2) }}</p>
                    
                    <!-- Reviews -->
                    <div class="mt-6 pb-6 border-b border-gray-200/50">
                        <h3 class="sr-only">Reviews</h3>
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <!-- Stars would go here -->
                            </div>
                            <p class="ml-3 text-sm font-medium text-blue-600/80 hover:text-blue-600 cursor-pointer transition-colors">{{ count($item->reviews) }} reviews</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Description</h3>
                        <div class="text-gray-600 leading-relaxed prose prose-gray max-w-none">
                            {!! nl2br(e($item->description)) !!}
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <form action="{{ route('cart.add', $item->id) }}" method="POST" class="mt-8">
                        @csrf
                        <button type="submit" class="w-full bg-gradient-to-r from-gray-900 to-gray-800 hover:from-gray-800 hover:to-gray-700 text-white font-medium py-4 px-8 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="mt-20 max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="bg-white/70 backdrop-blur-sm rounded-xl shadow-sm border border-gray-200/50 p-8">
                <h2 class="text-2xl font-light text-gray-900 mb-8">Customer Reviews</h2>
                
                @auth
                <div class="bg-gradient-to-r from-gray-50/80 to-gray-100/80 backdrop-blur-sm p-8 rounded-xl border border-gray-200/50 mb-10">
                    <h3 class="text-xl font-medium text-gray-900 mb-6">Leave a Review</h3>
                    <form action="{{ route('items.reviews.store', $item->id) }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <select name="rating" id="rating" class="w-full px-4 py-3 border border-gray-300/60 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-500/20 focus:border-gray-500/60 transition-all duration-200 bg-white/80">
                                <option value="5">⭐⭐⭐⭐⭐ 5 Stars</option>
                                <option value="4">⭐⭐⭐⭐ 4 Stars</option>
                                <option value="3">⭐⭐⭐ 3 Stars</option>
                                <option value="2">⭐⭐ 2 Stars</option>
                                <option value="1">⭐ 1 Star</option>
                            </select>
                        </div>
                        <div>
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                            <textarea name="comment" id="comment" rows="4" required 
                                class="w-full px-4 py-3 border border-gray-300/60 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-500/20 focus:border-gray-500/60 transition-all duration-200 bg-white/80"
                                placeholder="Share your experience with this product..."></textarea>
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-emerald-600/90 to-emerald-700/90 hover:from-emerald-600 hover:to-emerald-700 text-white font-medium py-3 px-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Submit Review
                        </button>
                    </form>
                </div>
                @else
                <div class="bg-blue-50/80 border border-blue-200/60 rounded-xl p-6 mb-10 backdrop-blur-sm">
                    <p class="text-blue-800/90">Please <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800 underline transition-colors">log in</a> to leave a review.</p>
                </div>
                @endauth

                <!-- Reviews List -->
                <div class="space-y-6">
                    @forelse($item->reviews as $review)
                    <div class="bg-gray-50/60 backdrop-blur-sm rounded-xl p-6 border border-gray-200/40">
                        <div class="flex space-x-4">
                            <div class="flex-shrink-0">
                                <div class="h-11 w-11 rounded-full bg-gradient-to-r from-gray-600 to-gray-700 flex items-center justify-center shadow-sm">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star text-sm {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                                <p class="text-gray-700 leading-relaxed mb-3">{{ $review->comment }}</p>
                                <p class="text-sm text-gray-500 font-medium">{{ $review->user_name }} • {{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <i class="fas fa-comments text-3xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg font-light">No reviews yet. Be the first to review!</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
