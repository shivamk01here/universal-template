@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-gray-50 via-white to-gray-50 min-h-screen">
    <div class="pt-6 pb-16">

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
                            {{ $item->location ?? 'Location' }}
                        </p>
                    </div>
                    <div class="flex items-center space-x-3 mt-4 md:mt-0">
                        <button type="button" class="p-3 rounded-full bg-white/80 backdrop-blur-sm shadow-sm border border-gray-200/60 text-gray-500 hover:text-rose-500 hover:bg-rose-50/70 transition-all" title="Add to Wishlist">
                            <i class="far fa-heart fa-lg"></i>
                        </button>
                        <button type="button" class="p-3 rounded-full bg-white/80 backdrop-blur-sm shadow-sm border border-gray-200/60 text-gray-500 hover:text-blue-600 hover:bg-blue-50/70 transition-all" title="Share">
                            <i class="fas fa-share-alt fa-lg"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Image gallery -->
            <div class="mt-8 lg:mt-0 flex justify-center">
                @php
                    $imageUrl = $item->images[0]->image_url ?? 'https://placehold.co/800x600';
                @endphp
                <div class="w-full max-w-md rounded-xl overflow-hidden shadow-lg bg-gradient-to-br from-gray-100 to-gray-50 ring-1 ring-gray-200/60">
                    <img src="{{ $imageUrl }}" alt="{{ $item->name }}" class="w-full h-auto object-contain">
                </div>
            </div>

            <!-- Item info -->
            <div class="mt-8 lg:mt-0 lg:pl-6">
                <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-200/60 p-8">
                    <h2 class="text-2xl font-light tracking-tight text-gray-900">{{ $item->name }}</h2>
                    <p class="text-3xl font-light text-gray-900 mt-6">₹{{ number_format((float)($item->base_price ?? 0), 2) }}</p>

                    <!-- Reviews -->
                    <div class="mt-6 pb-6 border-b border-gray-200/60">
                        <div class="flex items-center">
                            @php
                                $avg = (float)($item->average_rating ?? 0);
                                $revCount = is_iterable($item->reviews ?? []) ? count($item->reviews) : 0;
                            @endphp
                            <div class="flex items-center" aria-label="Rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-sm {{ $i <= round($avg) ? 'text-amber-400' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>
                            <p class="ml-3 text-sm font-medium text-blue-600/90 hover:text-blue-600 cursor-pointer transition-colors">
                                {{ $revCount }} {{ Str::plural('review', $revCount) }}
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Description</h3>
                        <div class="text-gray-700 leading-relaxed prose prose-gray max-w-none">
                            {!! nl2br(e($item->description ?? '')) !!}
                        </div>
                    </div>

                    <!-- Add to Cart / Service Modal Trigger -->
                    <div class="mt-8">
                        @if(($item->item_type ?? null) === 'SERVICE')
                            <button type="button" id="add-service-btn"
                                    class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-600 hover:to-indigo-600 text-white font-medium py-4 px-8 rounded-lg shadow-sm hover:shadow-md transition-all focus:ring-2 focus:ring-indigo-500/30 focus:outline-none">
                                <i class="fas fa-calendar-plus mr-2"></i>
                                Add to Cart
                            </button>
                        @else
                            <form action="{{ route('cart.add', $item->id) }}" method="POST" class="space-y-3">
                                @csrf
                                <button type="submit"
                                        class="w-full bg-gradient-to-r from-gray-900 to-gray-800 hover:from-gray-800 hover:to-gray-700 text-white font-medium py-4 px-8 rounded-lg shadow-sm hover:shadow-md transition-all focus:ring-2 focus:ring-gray-500/30 focus:outline-none">
                                    <i class="fas fa-shopping-cart mr-2"></i>
                                    Add to Cart
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="mt-16 max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-sm border border-gray-200/60 p-8">
                <h2 class="text-2xl font-light text-gray-900 mb-8">Customer Reviews</h2>

                @auth
                    <div class="bg-gradient-to-r from-gray-50/80 to-gray-100/80 backdrop-blur-sm p-8 rounded-xl border border-gray-200/60 mb-10">
                        <h3 class="text-xl font-medium text-gray-900 mb-6">Leave a Review</h3>
                        <form action="{{ route('items.reviews.store', $item->id) }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                <select name="rating" id="rating" class="w-full px-4 py-3 border border-gray-300/70 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-500/20 focus:border-gray-500/60 bg-white/90">
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
                                          class="w-full px-4 py-3 border border-gray-300/70 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-500/20 focus:border-gray-500/60 bg-white/90"
                                          placeholder="Share your experience with this product..."></textarea>
                            </div>
                            <button type="submit" class="bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-600 hover:to-emerald-600 text-white font-medium py-3 px-6 rounded-lg shadow-sm hover:shadow-md transition-all focus:ring-2 focus:ring-emerald-500/30 focus:outline-none">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Submit Review
                            </button>
                        </form>
                    </div>
                @else
                    <div class="bg-blue-50/80 border border-blue-200/60 rounded-xl p-6 mb-10 backdrop-blur-sm">
                        <p class="text-blue-900/90">Please <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800 underline transition-colors">log in</a> to leave a review.</p>
                    </div>
                @endauth

                <!-- Reviews List -->
                <div class="space-y-6">
                    @php $reviews = is_iterable($item->reviews ?? []) ? $item->reviews : []; @endphp
                    @forelse($reviews as $review)
                        <div class="bg-gray-50/70 backdrop-blur-sm rounded-xl p-6 border border-gray-200/50">
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="h-11 w-11 rounded-full bg-gradient-to-r from-gray-600 to-gray-700 flex items-center justify-center shadow-sm">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center mb-2" aria-label="User rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-sm {{ $i <= (int)($review->rating ?? 0) ? 'text-amber-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                    </div>
                                    <p class="text-gray-700 leading-relaxed mb-3">{{ $review->comment ?? '' }}</p>
                                    <p class="text-sm text-gray-500 font-medium">
                                        {{ $review->user_name ?? 'User' }} •
                                        {{ \Carbon\Carbon::parse($review->created_at ?? now())->format('M d, Y') }}
                                    </p>
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

@if(($item->item_type ?? null) === 'SERVICE')
<!-- Service Details Modal -->
<div id="service-modal"
     class="fixed inset-0 z-50 hidden"
     aria-labelledby="service-modal-title"
     role="dialog"
     aria-modal="true">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gray-900/60 transition-opacity" id="service-modal-overlay"></div>

    <!-- Panel -->
    <div class="relative mx-auto w-full max-w-md px-4 sm:px-0 top-24">
        <div class="bg-white rounded-xl shadow-xl ring-1 ring-black/5 overflow-hidden">
            <div class="px-6 pt-5 pb-4">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 id="service-modal-title" class="text-lg leading-6 font-semibold text-gray-900">Service Details</h3>
                        <p class="mt-1 text-sm text-gray-500">Choose your preferred date, time, and location.</p>
                    </div>
                    <button id="close-modal-btn" class="p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300/50" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="service-details-form" class="space-y-4 mt-5">
                    <div>
                        <label for="service_date" class="block text-sm font-medium text-gray-700">Preferred Date</label>
                        <input type="date" id="service_date" name="date" required
                               class="mt-1 block w-full rounded-md border border-gray-300/80 bg-white/90 px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/60">
                        <p class="mt-1 text-xs text-gray-500">Select an available date.</p>
                    </div>
                    <div>
                        <label for="service_time" class="block text-sm font-medium text-gray-700">Preferred Time</label>
                        <input type="time" id="service_time" name="time" required
                               class="mt-1 block w-full rounded-md border border-gray-300/80 bg-white/90 px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/60">
                    </div>
                    <div>
                        <label for="service_location" class="block text-sm font-medium text-gray-700">Service Location / Address</label>
                        <textarea id="service_location" name="location" rows="3" required
                                  class="mt-1 block w-full rounded-md border border-gray-300/80 bg-white/90 px-3 py-2 shadow-sm focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500/60"
                                  placeholder="Apartment, street, city, postal code"></textarea>
                    </div>
                </form>
            </div>
            <div class="px-6 pb-6">
                <button id="confirm-service-btn"
                        class="w-full px-4 py-3 bg-indigo-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 disabled:opacity-70 disabled:cursor-not-allowed">
                    Confirm & Add to Cart
                </button>
                <button id="cancel-modal-btn"
                        class="mt-2 w-full px-4 py-3 bg-gray-100 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300/40">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Toast -->
<div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-[60] hidden">
    <div id="toast-inner" class="rounded-lg px-4 py-3 shadow-lg text-white text-sm"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal     = document.getElementById('service-modal');
    const overlay   = document.getElementById('service-modal-overlay');
    const addBtn    = document.getElementById('add-service-btn');
    const closeBtn  = document.getElementById('close-modal-btn');
    const cancelBtn = document.getElementById('cancel-modal-btn');
    const confirmBtn= document.getElementById('confirm-service-btn');
    const form      = document.getElementById('service-details-form');

    // Open/Close helpers
    const openModal = () => {
        modal.classList.remove('hidden');
        // Focus first input
        setTimeout(() => document.getElementById('service_date')?.focus(), 0);
        trapFocus(modal);
    };
    const closeModal = () => {
        modal.classList.add('hidden');
        releaseFocus();
    };

    addBtn?.addEventListener('click', openModal);
    closeBtn?.addEventListener('click', closeModal);
    cancelBtn?.addEventListener('click', closeModal);
    overlay?.addEventListener('click', closeModal);
    document.addEventListener('keydown', (e) => {
        if (!modal.classList.contains('hidden') && e.key === 'Escape') closeModal();
    });

    // Submit SERVICE details
    confirmBtn?.addEventListener('click', async () => {
        // basic client-side validation
        const dateEl = document.getElementById('service_date');
        const timeEl = document.getElementById('service_time');
        const locEl  = document.getElementById('service_location');

        if (!dateEl.value || !timeEl.value || !locEl.value.trim()) {
            showToast('Please complete all fields.', 'error');
            return;
        }

        confirmBtn.disabled = true;
        const originalText = confirmBtn.textContent;
        confirmBtn.textContent = 'Adding...';

        try {
            const response = await fetch("{{ route('cart.add', $item->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    quantity: 1,
                    service_details: {
                        date: dateEl.value,
                        time: timeEl.value,
                        location: locEl.value.trim()
                    }
                })
            });

            if (response.ok) {
                showToast('Service added to cart!', 'success');
                closeModal();
                window.location.href = "{{ route('cart.index') }}";
            } else {
                const data = await safeJson(response);
                const msg = data?.message || 'Failed to add service to cart.';
                showToast(msg, 'error');
            }
        } catch (err) {
            showToast('Network error. Please try again.', 'error');
        } finally {
            confirmBtn.disabled = false;
            confirmBtn.textContent = originalText;
        }
    });

    // Toast utility
    function showToast(message, type = 'info') {
        const toast = document.getElementById('toast');
        const inner = document.getElementById('toast-inner');
        const palette = {
            success: 'bg-emerald-600',
            error: 'bg-rose-600',
            info: 'bg-gray-800',
        };
        inner.className = 'rounded-lg px-4 py-3 shadow-lg text-white text-sm ' + (palette[type] || palette.info);
        inner.textContent = message;
        toast.classList.remove('hidden');
        clearTimeout(showToast._t);
        showToast._t = setTimeout(() => toast.classList.add('hidden'), 2500);
    }

    async function safeJson(resp) {
        try { return await resp.json(); } catch { return null; }
    }

    // Minimal focus trap
    let lastFocus = null;
    function trapFocus(container) {
        lastFocus = document.activeElement;
        const focusable = container.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        const first = focusable[0];
        const last  = focusable[focusable.length - 1];
        container.addEventListener('keydown', handleTrap);
        function handleTrap(e) {
            if (e.key !== 'Tab') return;
            if (e.shiftKey) {
                if (document.activeElement === first) {
                    e.preventDefault();
                    last.focus();
                }
            } else {
                if (document.activeElement === last) {
                    e.preventDefault();
                    first.focus();
                }
            }
        }
        trapFocus._handler = handleTrap;
    }
    function releaseFocus() {
        modal.removeEventListener('keydown', trapFocus._handler || (() => {}));
        if (lastFocus) lastFocus.focus();
    }
});
</script>
@endif
@endsection
