<section id="faq" class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">{{ $content->heading ?? 'FAQ' }}</h2>
            <p class="text-gray-600 mt-2">{{ $content->subheading ?? '' }}</p>
        </div>
        <div class="max-w-3xl mx-auto">
            <div class="space-y-4">
                @foreach($faqs as $faq)
                <details class="bg-gray-50 p-4 rounded-lg cursor-pointer">
                    <summary class="font-semibold text-gray-800">{{ $faq->question }}</summary>
                    <p class="text-gray-600 mt-2">{{ $faq->answer }}</p>
                </details>
                @endforeach
            </div>
        </div>
    </div>
</section>