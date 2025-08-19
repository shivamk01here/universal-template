@extends('layouts.app')

@section('content')
<div class="theme-gradient-primary min-h-screen pt-6 pb-20">
    <!-- Full-width container -->
    <div class="w-full px-4 sm:px-6 lg:px-10 xl:px-14 2xl:px-20">

        <!-- Breadcrumb -->
        <div class="mb-10">
            <nav class="flex items-center space-x-2 text-sm theme-text-muted">
                <a href="{{ route('home') }}" class="hover:theme-text-primary transition-colors">Home</a>
                <i class="fas fa-chevron-right text-xs theme-text-muted/60"></i>
                <span class="theme-text-primary font-medium">Shopping Cart</span>
            </nav>
        </div>

        <!-- Wide layout: two columns on xl+, stacked on smaller screens -->
        <div class="grid grid-cols-12 gap-8 items-start">
            <!-- Left: Cart items -->
            <div class="col-span-12 xl:col-span-8 2xl:col-span-9">
                @if(count($cartItems) > 0)
                <section class="theme-bg-primary/70 backdrop-blur-sm rounded-xl shadow-sm theme-border border overflow-hidden">
                    <ul role="list" class="divide-y theme-border divide-solid">
                        @foreach($cartItems as $item)
                        <li class="flex py-8 px-6 md:py-10 md:px-10 hover:theme-bg-tertiary/50 transition-colors duration-200">
                            <div class="flex-shrink-0">
                                <div class="w-32 h-32 sm:w-40 sm:h-40 md:w-44 md:h-44 rounded-xl overflow-hidden theme-gradient-secondary ring-1 theme-border">
                                    <img src="{{ $item->primary_image ?? 'https://placehold.co/300x300' }}" 
                                         alt="{{ $item->name }}" 
                                         class="w-full h-full object-center object-cover">
                                </div>
                            </div>
                            <div class="ml-6 md:ml-10 flex-1 flex flex-col">
                                <div>
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                                        <h4 class="text-lg md:text-xl">
                                            <a href="{{ route('items.show', $item->slug) }}" 
                                               class="font-medium theme-text-primary hover:theme-text-secondary transition-colors duration-200">
                                                {{ $item->name }}
                                            </a>
                                        </h4>
                                        <p class="text-lg md:text-xl font-medium theme-text-primary">₹{{ number_format($item->total_price, 2) }}</p>
                                    </div>
                                    <p class="mt-3 text-base theme-text-muted">Unit Price: ₹{{ number_format($item->base_price, 2) }}</p>
                                </div>
                                <div class="mt-6 md:mt-8 flex-1 flex items-end justify-between">
                                    <!-- Quantity form with - / + buttons -->
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center space-x-4" id="qty-form-{{ $item->id }}">
                                        @csrf
                                        <label for="quantity-{{$item->id}}" class="text-base font-medium theme-text-secondary">Qty:</label>
                                        <div class="inline-flex items-stretch rounded-lg shadow-sm">
                                            <button 
                                                type="button"
                                                class="px-3 md:px-4 py-3 theme-text-secondary hover:theme-text-primary theme-bg-primary/90 border theme-border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary-dynamic/20"
                                                data-action="decrement"
                                                data-target="quantity-{{$item->id}}"
                                                aria-label="Decrease quantity"
                                            >
                                                <i class="fas fa-minus text-sm"></i>
                                            </button>
                                            <input
                                                type="number"
                                                id="quantity-{{$item->id}}"
                                                name="quantity"
                                                value="{{ $item->quantity }}"
                                                class="w-20 md:w-24 text-center px-3 py-3 text-base theme-border border-y theme-bg-primary/90 focus:ring-2 focus:ring-primary-dynamic/20 focus:border-primary-dynamic/60"
                                                min="1"
                                                onchange="this.form.submit()"
                                            >
                                            <button 
                                                type="button"
                                                class="px-3 md:px-4 py-3 theme-text-secondary hover:theme-text-primary theme-bg-primary/90 border theme-border rounded-r-lg focus:outline-none focus:ring-2 focus:ring-primary-dynamic/20"
                                                data-action="increment"
                                                data-target="quantity-{{$item->id}}"
                                                aria-label="Increase quantity"
                                            >
                                                <i class="fas fa-plus text-sm"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <div class="ml-6">
                                        <a href="{{ route('cart.remove', $item->id) }}" 
                                           class="text-base font-medium text-red-600/80 hover:text-red-600 transition-colors duration-200 flex items-center">
                                            <i class="fas fa-trash-alt mr-2"></i>
                                            Remove
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </section>
                @else
                <!-- Empty cart - full width aesthetic -->
                <div class="theme-bg-primary/70 backdrop-blur-sm rounded-xl shadow-sm theme-border border text-center py-20 px-8">
                    <div class="max-w-3xl mx-auto">
                        <!-- SVG Illustration -->
                        <div class="flex justify-center mb-10">
                            <svg width="140" height="140" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="scale-110">
                                <rect width="120" height="120" rx="24" fill="#EEF2FF"/>
                                <path d="M32 40h56l-6 32H48l-8-32z" fill="#C7D2FE"/>
                                <ellipse cx="50" cy="80" rx="6" ry="6" fill="#A5B4FC"/>
                                <ellipse cx="86" cy="80" rx="6" ry="6" fill="#A5B4FC"/>
                                <rect x="40" y="48" width="44" height="8" rx="4" fill="#DBEAFE"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-medium theme-text-primary mb-4">Your cart is empty</h2>
                        <p class="text-lg theme-text-muted mb-10">
                            Looks like you haven't added anything to your cart yet.<br class="hidden sm:block">
                            Browse products and start shopping!
                        </p>
                        <a href="{{ route('items.index') }}" 
                           class="inline-flex items-center text-lg font-medium text-button-dynamic hover:opacity-90 transition-colors duration-200 group">
                            Continue Shopping
                            <i class="fas fa-arrow-right ml-3 text-base transform group-hover:translate-x-1 transition-transform duration-200"></i>
                        </a>
                    </div>
                </div>
                @endif
            </div>

            @if(count($cartItems) > 0)
            <!-- Right: Order summary -->
            <div class="col-span-12 xl:col-span-4 2xl:col-span-3">
                <div class="mt-8 xl:mt-0 theme-bg-primary/70 backdrop-blur-sm rounded-xl shadow-sm theme-border border p-8 xl:sticky xl:top-8">
                    <h2 class="text-2xl font-medium theme-text-primary mb-8">Order Summary</h2>
                    <div class="flow-root">
                        <dl class="space-y-6 text-base">
                            <div class="flex items-center justify-between py-4 theme-border border-b">
                                <dt class="theme-text-secondary">Subtotal</dt>
                                <dd class="font-medium theme-text-primary">₹{{ number_format($subTotal, 2) }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-4 theme-border border-b">
                                <dt class="theme-text-secondary">Shipping</dt>
                                <dd class="font-medium theme-text-primary">Free</dd>
                            </div>
                            <div class="flex items-center justify-between py-5 theme-border border-t">
                                <dt class="text-lg font-medium theme-text-primary">Order Total</dt>
                                <dd class="text-2xl font-medium theme-text-primary">₹{{ number_format($subTotal, 2) }}</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="mt-10 space-y-5">
                        <a href="{{ route('checkout.index') }}" class="w-full bg-button-dynamic hover:opacity-90 text-white font-medium py-5 px-8 text-lg rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5 block text-center">
                            <i class="fas fa-credit-card mr-3"></i> Proceed to Checkout
                        </a>
                        <a href="{{ route('items.index') }}" 
                           class="w-full theme-bg-tertiary/80 hover:theme-bg-secondary/80 theme-text-secondary hover:theme-text-primary font-medium py-4 px-8 text-base rounded-lg transition-all duration-200 block text-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Continue Shopping
                        </a>
                    </div>
                    <!-- Trust indicators -->
                    <div class="mt-10 pt-8 theme-border border-t">
                        <div class="grid grid-cols-2 gap-6 text-center">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-shield-alt text-green-500 text-xl mb-3"></i>
                                <span class="text-sm theme-text-muted">Secure Checkout</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <i class="fas fa-truck text-blue-500 text-xl mb-3"></i>
                                <span class="text-sm theme-text-muted">Free Shipping</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

<!-- Inline script to handle +/- quantity -->
<script>
 document.addEventListener('DOMContentLoaded', function () {
   document.querySelectorAll('button[data-action]').forEach(function (btn) {
     btn.addEventListener('click', function () {
       const targetId = this.getAttribute('data-target');
       const action = this.getAttribute('data-action');
       const input = document.getElementById(targetId);
       if (!input) return;

       const min = parseInt(input.getAttribute('min') || '1', 10);
       const current = parseInt(input.value || '1', 10);

       let next = current;
       if (action === 'increment') next = current + 1;
       if (action === 'decrement') next = Math.max(min, current - 1);

       if (next !== current) {
         input.value = next;

         // Submit the associated form
         const form = input.closest('form');
         if (form) form.submit();
       }
     });
   });
 });
</script>
@endsection

<style>
.theme-gradient-primary {
    background: linear-gradient(to bottom, var(--theme-tertiary, #f9fafb), var(--theme-primary, #fff));
}
[data-theme="dark"] .theme-gradient-primary {
    background: linear-gradient(to bottom, var(--theme-secondary, #1f2937), var(--theme-tertiary, #111827));
}
.theme-gradient-secondary {
    background: linear-gradient(to bottom right, var(--theme-tertiary, #f3f4f6), var(--theme-primary, #fff) 100%);
}
[data-theme="dark"] .theme-gradient-secondary {
    background: linear-gradient(to bottom right, var(--theme-secondary, #1f2937), var(--theme-primary, #111827) 100%);
}
</style>
