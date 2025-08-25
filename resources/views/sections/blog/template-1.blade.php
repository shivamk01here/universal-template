<section id="blog" style="background-color: {{ $content->bg_color ?? '#FFF' }};" class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">{{ $content->heading ?? 'From Our Blog' }}</h2>
            <p class="text-gray-600 mt-2">{{ $content->subheading ?? '' }}</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @forelse($blogs as $post)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <a href="#">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                </a>
                <div class="p-6">
                    <p class="text-sm text-gray-500 mb-2">{{ date('M d, Y', strtotime($post->created_at)) }}</p>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        <a href="#" class="hover:text-indigo-600 transition">{{ $post->title }}</a>
                    </h3>
                    <!-- <p class="text-gray-600 mb-4">{{ $post->content }}</p> -->
                    <a href="{{ route('blogs.show', $post->slug) }}"  class="font-semibold text-indigo-600 hover:text-indigo-800 transition">Read More &rarr;</a>
                </div>
            </div>
            @empty
            <p class="md:col-span-3 text-center text-gray-500">No blog posts found.</p>
            @endforelse
        </div>
    </div>
</section>