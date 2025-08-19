@extends('layouts.app')

@section('content')
<div class="theme-gradient-primary min-h-screen">
    <div class="pt-6 pb-16">

        <!-- Breadcrumb -->
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mb-6">
            <nav class="flex items-center space-x-2 text-sm theme-text-muted">
                <a href="{{ route('home') }}" class="hover:theme-text-primary transition-colors">Home</a>
                <i class="fas fa-chevron-right text-xs theme-text-muted/60"></i>
                <a href="{{ route('items.index') }}" class="hover:theme-text-primary transition-colors">Items</a>
                <i class="fas fa-chevron-right text-xs theme-text-muted/60"></i>
                <span class="theme-text-primary font-medium">{{ $item->name }}</span>
            </nav>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-x-16 items-center min-h-[580px]">

            <!-- GALLERY COLUMN (LEFT) -->
            <div class="flex flex-row-reverse items-center">
                <!-- Thumbnails (scrollable vertically) -->
                <div id="thumbs" class="flex flex-col space-y-3 h-[450px] overflow-y-auto mr-4">
                    @foreach($item->images as $k => $img)
                    <button 
                        class="border-2 border-transparent hover:border-primary-dynamic rounded-lg overflow-hidden focus:outline-none transition"
                        onclick="setMainImg('{{ asset($img->image_url) }}', {{ $k }})"
                        id="thumb-btn-{{ $k }}">
                        <img src="{{ asset($img->image_url) }}" 
                             class="w-16 h-16 object-cover {{ $k === 0 ? 'ring-2 ring-emerald-500' : '' }}" 
                             alt="Thumbnail">
                    </button>
                    @endforeach
                </div>
                <!-- Larger main image -->
                <div class="ml-6 w-[430px] h-[430px] rounded-2xl overflow-hidden theme-border border theme-bg-primary shadow-md flex items-center justify-center max-w-full">
                    <img 
                        id="main-img" 
                        src="{{ count($item->images) ? asset($item->images[0]->image_url) : '' }}" 
                        alt="{{ $item->name }}" 
                        class="block w-full h-full object-cover transition-all duration-200"
                    >
                </div>
            </div>

            <!-- DESCRIPTION + ACTIONS (RIGHT) -->
            <div class="mt-8 lg:mt-0 lg:pl-6 flex flex-col justify-center h-full">
                <div class="theme-bg-primary/90 backdrop-blur-sm rounded-xl shadow-md theme-border border p-8">
                    <h1 class="text-4xl font-light theme-text-primary tracking-tight">{{ $item->name }}</h1>
                    <p class="mt-2 theme-text-muted flex items-center text-sm">
                        <i class="fas fa-map-marker-alt mr-2 theme-text-muted/70"></i>
                        {{ $item->location ?? 'Location' }}
                    </p>
                    <p class="text-3xl font-light theme-text-primary mt-6">₹{{ number_format((float)($item->base_price ?? 0), 2) }}</p>

                    <!-- Reviews Star & Count -->
                    <div class="mt-6 pb-6 theme-border border-b">
                        @php
                            $avg = (float)($item->average_rating ?? 0);
                            $revCount = is_iterable($item->reviews ?? []) ? count($item->reviews) : 0;
                        @endphp
                        <div class="flex items-center">
                            <div class="flex items-center space-x-0.5" aria-label="Rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-6 w-6 
                                        {{ $i <= round($avg) ? 'text-amber-400' : 'theme-text-muted/30' }} 
                                        transition"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.985a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.363 1.118l1.287 3.985c.3.921-.755 1.688-1.54 1.118l-3.39-2.462a1 1 0 00-1.176 0l-3.39 2.462c-.784.57-1.838-.197-1.54-1.118l1.287-3.985a1 1 0 00-.363-1.118L2.04 9.412c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.985z"/>
                                    </svg>
                                @endfor
                            </div>
                            <p class="ml-3 text-base font-medium text-blue-600/90 hover:text-blue-600 cursor-pointer transition-colors">
                                {{ $revCount }} {{ Str::plural('review', $revCount) }}
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium theme-text-primary mb-4">Description</h3>
                        <div class="theme-text-secondary leading-relaxed prose prose-gray max-w-none">
                            {!! nl2br(e($item->description ?? '')) !!}
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-8">
                        @if(($item->item_type ?? null) === 'SERVICE')
                            <button type="button" id="add-service-btn"
                                class="w-full bg-gradient-to-r from-primary-dynamic to-secondary-dynamic hover:from-primary-dynamic hover:to-secondary-dynamic text-white font-medium py-4 px-8 rounded-lg shadow-md hover:shadow-lg transition-all focus:ring-2 focus:ring-primary-dynamic/30 focus:outline-none">
                                <i class="fas fa-calendar-plus mr-2"></i>
                                Add to Cart
                            </button>
                        @else
                            <form action="{{ route('cart.add', $item->id) }}" method="POST" class="space-y-3">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-button-dynamic hover:opacity-90 text-white font-medium py-4 px-8 rounded-lg shadow-md hover:shadow-lg transition-all focus:ring-2 focus:ring-button-dynamic/30 focus:outline-none">
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
            <div class="theme-bg-primary/90 backdrop-blur-sm rounded-xl shadow-md theme-border border p-8">
                <h2 class="text-2xl font-light theme-text-primary mb-8">Customer Reviews</h2>
                @auth
                    <!-- Leave Review Form -->
                    <div class="theme-gradient-secondary backdrop-blur-sm p-8 rounded-xl theme-border border mb-10">
                        <h3 class="text-xl font-medium theme-text-primary mb-6">Leave a Review</h3>
                        <form action="{{ route('items.reviews.store', $item->id) }}" method="POST" class="space-y-6">
                            @csrf
                            <!-- Play Store Star style -->
                            <div>
                                <label for="rating" class="block text-sm font-medium theme-text-secondary mb-2">Rating</label>
                                <div id="star-input" class="flex items-center space-x-2 text-2xl">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span 
                                            class="star cursor-pointer theme-text-muted hover:text-amber-400 transition"
                                            data-value="{{ $i }}">&#9733;</span>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="star-rating" value="5"/>
                            </div>
                            <div>
                                <label for="comment" class="block text-sm font-medium theme-text-secondary mb-2">Your Review</label>
                                <textarea name="comment" id="comment" rows="4" required
                                    class="w-full px-4 py-3 theme-border border rounded-lg shadow-sm focus:ring-2 focus:ring-primary-dynamic/20 focus:border-primary-dynamic/60 theme-bg-primary/90 dark:bg-gray-900/80 theme-text-primary placeholder-theme-text-muted dark:placeholder-gray-400"
                                    placeholder="Share your experience with this product..."></textarea>
                            </div>
                            <button type="submit" class="bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-medium py-3 px-6 rounded-lg shadow-sm hover:shadow-md transition-all focus:ring-2 focus:ring-emerald-500/30 focus:outline-none">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Submit Review
                            </button>
                        </form>
                    </div>
                    <script>
                        // Play Store style interactive stars for review
                        document.addEventListener('DOMContentLoaded', () => {
                            const stars = document.querySelectorAll('#star-input .star');
                            const input = document.getElementById('star-rating');
                            let curr = 5;
                            stars.forEach((star, idx) => {
                                star.addEventListener('mouseenter', function() {
                                    highlight(idx+1);
                                });
                                star.addEventListener('mouseleave', function() {
                                    highlight(curr);
                                });
                                star.addEventListener('click', function() {
                                    curr = idx+1;
                                    input.value = curr;
                                    highlight(curr);
                                });
                            });
                            function highlight(rating) {
                                stars.forEach((star, idx) => {
                                    star.classList.toggle('text-amber-400', idx < rating);
                                    star.classList.toggle('theme-text-muted', idx >= rating);
                                });
                            }
                            highlight(curr);
                        });
                    </script>
                @else
                    <div class="theme-bg-secondary/80 theme-border border rounded-xl p-6 mb-10 backdrop-blur-sm">
                        <p class="theme-text-secondary">Please <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800 underline transition-colors">log in</a> to leave a review.</p>
                    </div>
                @endauth

                <!-- Reviews List -->
                <div class="space-y-6 max-h-96 overflow-y-auto pr-2">
                    @php $reviews = is_iterable($item->reviews ?? []) ? $item->reviews : []; @endphp
                    @forelse($reviews as $review)
                        <div class="theme-bg-tertiary/70 backdrop-blur-sm rounded-xl p-6 theme-border border shadow-sm">
                            <div class="flex space-x-4 items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-11 w-11 rounded-full bg-gradient-to-r from-emerald-700 to-emerald-900 flex items-center justify-center shadow">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center mb-2" aria-label="User rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="h-5 w-5 {{ $i <= (int)($review->rating ?? 0) ? 'text-amber-400' : 'theme-text-muted/30' }} transition" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.985a1 1 0 00.95.69h4.184c.969 0 1.371 1.24.588 1.81l-3.39 2.462a1 1 0 00-.363 1.118l1.287 3.985c.3.921-.755 1.688-1.54 1.118l-3.39-2.462a1 1 0 00-1.176 0l-3.39 2.462c-.784.57-1.838-.197-1.54-1.118l1.287-3.985a1 1 0 00-.363-1.118L2.04 9.412c-.783-.57-.38-1.81.588-1.81h4.184a1 1 0 00.95-.69l1.286-3.985z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="theme-text-secondary leading-relaxed mb-3">{{ $review->comment ?? '' }}</p>
                                    <p class="text-sm theme-text-muted font-medium">
                                        {{ $review->user_name ?? 'User' }} •
                                        {{ \Carbon\Carbon::parse($review->created_at ?? now())->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 theme-text-muted text-lg font-light">
                            <i class="fas fa-comments text-3xl theme-text-muted/50 mb-4"></i>
                            No reviews yet. Be the first to review!
                        </div>
                    @endforelse
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
        <div class="absolute inset-0 bg-black/70 transition-opacity" id="service-modal-overlay"></div>

        <!-- Panel -->
        <div class="relative mx-auto w-full max-w-md px-4 sm:px-0 top-24">
            <div class="theme-bg-primary rounded-xl shadow-xl ring-1 ring-black/5 overflow-hidden">

                <div class="px-6 pt-5 pb-4">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 id="service-modal-title" class="text-lg leading-6 font-semibold theme-text-primary">Service Details</h3>
                            <p class="mt-1 text-sm theme-text-muted">Choose your preferred date, time, and location.</p>
                        </div>
                        <button id="close-modal-btn" class="p-2 rounded-md theme-text-muted hover:theme-text-primary hover:theme-bg-tertiary focus:outline-none focus:ring-2 focus:ring-primary-dynamic/50" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form id="service-details-form" class="space-y-4 mt-5">
                        <div>
                            <label for="service_date" class="block text-sm font-medium theme-text-secondary mb-1">Preferred Date</label>
                            <input type="date" id="service_date" name="date" required
                                class="mt-1 block w-full rounded-xl theme-border border-primary-dynamic/40 bg-tertiary-dynamic px-4 py-2 text-lg shadow focus:ring-2 focus:ring-primary-dynamic/30 focus:border-primary-dynamic transition theme-text-primary">
                            <p class="mt-1 text-xs theme-text-muted">Select an available date.</p>
                        </div>
                        <div>
                            <label for="service_time" class="block text-sm font-medium theme-text-secondary mb-1">Preferred Time</label>
                            <input type="time" id="service_time" name="time" required
                                class="mt-1 block w-full rounded-xl theme-border border-primary-dynamic/40 bg-tertiary-dynamic px-4 py-2 text-lg shadow focus:ring-2 focus:ring-primary-dynamic/30 focus:border-primary-dynamic transition theme-text-primary">
                        </div>
                        <div>
                            <label for="service_location" class="block text-sm font-medium theme-text-secondary mb-1">Service Location / Address</label>
                            <textarea id="service_location" name="location" rows="3" required
                                class="mt-1 block w-full rounded-xl theme-border border-primary-dynamic/40 bg-tertiary-dynamic px-4 py-2 text-base shadow focus:ring-2 focus:ring-primary-dynamic/30 focus:border-primary-dynamic transition theme-text-primary"
                                placeholder="Apartment, street, city, postal code"></textarea>
                        </div>
                    </form>
                </div>
                <div class="px-6 pb-6">
                    <button id="confirm-service-btn"
                        class="w-full px-4 py-3 bg-button-dynamic text-white text-base font-medium rounded-md shadow-sm hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-button-dynamic/30 disabled:opacity-70 disabled:cursor-not-allowed transition">
                        Confirm & Add to Cart
                    </button>
                    <button id="cancel-modal-btn"
                        class="mt-2 w-full px-4 py-3 theme-bg-tertiary theme-text-secondary text-base font-medium rounded-md shadow-sm hover:theme-bg-secondary focus:outline-none focus:ring-2 focus:ring-primary-dynamic/40 transition">
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
        async function safeJson(resp) { try { return await resp.json(); } catch { return null; } }

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

    <script>
    // Gallery - Vertical thumbnails (Amazon Style)
    let mainImg = document.getElementById('main-img');
    let thumbs = document.querySelectorAll('#thumbs button');
    window.setMainImg = function(src, idx) {
        mainImg.src = src;
        thumbs.forEach((btn, i) => {
            let img = btn.querySelector('img');
            img.classList.toggle('ring-2', i == idx);
            img.classList.toggle('ring-emerald-500', i == idx);
            if (i !== idx) img.classList.remove('ring-2', 'ring-emerald-500');
        });
    }
    </script>
</div>
<style>
.theme-gradient-primary {
    background: linear-gradient(to bottom, var(--theme-tertiary, #f9fafb), var(--theme-primary, #fff), var(--theme-tertiary, #f9fafb));
}
[data-theme="dark"] .theme-gradient-primary {
    background: linear-gradient(to bottom, var(--theme-secondary, #1f2937), var(--theme-tertiary, #111827));
}
.theme-gradient-secondary {
    background: linear-gradient(to right, var(--theme-tertiary, #f3f4f6), var(--theme-primary, #fff) 100%);
    opacity: 1;
}
[data-theme="dark"] .theme-gradient-secondary {
    background: linear-gradient(to right, var(--theme-secondary, #1f2937), var(--theme-primary, #111827) 100%);
    opacity: 1;
}
</style>
@endsection
