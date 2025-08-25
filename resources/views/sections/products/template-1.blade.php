<section id="products" style="{{ getBackgroundStyle($content) }}" class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">{{ $content->heading ?? 'Our Products' }}</h2>
            <p class="text-gray-600 mt-2">{{ $content->subheading ?? '' }}</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @forelse($products as $product)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-56 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-indigo-600">${{ $product->price }}</span>
                        <a href="#" class="bg-indigo-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700 transition">View Details</a>
                    </div>
                </div>
            </div>
            @empty
            <p class="md:col-span-3 text-center text-gray-500">No products found.</p>
            @endforelse
        </div>
    </div>
</section>