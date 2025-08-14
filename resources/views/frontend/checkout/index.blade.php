@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 via-white to-gray-50">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-8 sm:py-10">

        <!-- Breadcrumb -->
        <nav class="mb-8 sm:mb-10 text-sm text-gray-500">
            <ol class="flex items-center gap-2">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-gray-700 transition-colors">Home</a>
                </li>
                <li>
                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                </li>
                <li>
                    <a href="{{ route('cart.index') }}" class="hover:text-gray-700 transition-colors">Cart</a>
                </li>
                <li>
                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                </li>
                <li class="text-gray-900 font-medium">Checkout</li>
            </ol>
        </nav>

        <form action="{{ route('checkout.placeOrder') }}" method="POST" class="lg:grid lg:grid-cols-12 lg:gap-10">
            @csrf

            <!-- Left: Contact & Shipping -->
            <section class="lg:col-span-7 space-y-6">

                <div class="rounded-2xl border border-gray-200/70 bg-white/90 shadow-sm backdrop-blur p-6 sm:p-8">
                    <div class="mb-6 flex items-start gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-700">
                            <i class="fa-solid fa-truck-fast"></i>
                        </span>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Checkout Information</h2>
                            <p class="text-sm text-gray-500">Please provide your contact and shipping details</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700">Full Name</label>
                            <input id="name" name="name" type="text" required
                                   class="w-full rounded-xl border border-gray-300/70 bg-white/95 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20 placeholder:text-gray-400"
                                   value="{{ old('name', auth()->user()->name ?? '') }}"
                                   placeholder="John Doe" autocomplete="name">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">Email Address</label>
                            <input id="email" name="email" type="email" required
                                   class="w-full rounded-xl border border-gray-300/70 bg-white/95 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20 placeholder:text-gray-400"
                                   value="{{ old('email', auth()->user()->email ?? '') }}"
                                   placeholder="you@example.com" autocomplete="email">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="mb-1.5 block text-sm font-medium text-gray-700">Phone Number</label>
                            <input id="phone" name="phone" type="tel" required
                                   class="w-full rounded-xl border border-gray-300/70 bg-white/95 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20 placeholder:text-gray-400"
                                   value="{{ old('phone') }}"
                                   placeholder="+91 98765 43210" autocomplete="tel">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="address_line_1" class="mb-1.5 block text-sm font-medium text-gray-700">Address Line 1</label>
                            <input id="address_line_1" name="address_line_1" type="text" required
                                   class="w-full rounded-xl border border-gray-300/70 bg-white/95 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20 placeholder:text-gray-400"
                                   value="{{ old('address_line_1') }}"
                                   placeholder="Street address, P.O. box" autocomplete="address-line1">
                            @error('address_line_1')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="address_line_2" class="mb-1.5 block text-sm font-medium text-gray-700">
                                Address Line 2 <span class="text-gray-400">(Optional)</span>
                            </label>
                            <input id="address_line_2" name="address_line_2" type="text"
                                   class="w-full rounded-xl border border-gray-300/70 bg-white/95 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20 placeholder:text-gray-400"
                                   value="{{ old('address_line_2') }}"
                                   placeholder="Apartment, suite, unit, etc." autocomplete="address-line2">
                        </div>

                        <div>
                            <label for="city" class="mb-1.5 block text-sm font-medium text-gray-700">City</label>
                            <input id="city" name="city" type="text" required
                                   class="w-full rounded-xl border border-gray-300/70 bg-white/95 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20 placeholder:text-gray-400"
                                   value="{{ old('city') }}"
                                   placeholder="City" autocomplete="address-level2">
                            @error('city')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="state" class="mb-1.5 block text-sm font-medium text-gray-700">State / Province</label>
                            <input id="state" name="state" type="text" required
                                   class="w-full rounded-xl border border-gray-300/70 bg-white/95 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20 placeholder:text-gray-400"
                                   value="{{ old('state') }}"
                                   placeholder="State" autocomplete="address-level1">
                            @error('state')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="pincode" class="mb-1.5 block text-sm font-medium text-gray-700">Postal Code</label>
                            <input id="pincode" name="pincode" type="text" required
                                   inputmode="numeric" pattern="[0-9]*"
                                   class="w-full rounded-xl border border-gray-300/70 bg-white/95 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20 placeholder:text-gray-400"
                                   value="{{ old('pincode') }}"
                                   placeholder="e.g., 110001" autocomplete="postal-code">
                            @error('pincode')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="rounded-2xl border border-blue-200/60 bg-blue-50/70 p-4 sm:p-5 backdrop-blur">
                    <div class="flex items-start gap-3">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white text-blue-600 shadow-sm">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </span>
                        <div>
                            <h4 class="text-sm font-semibold text-blue-900">Cash on Delivery</h4>
                            <p class="text-xs text-blue-700">Pay when your order arrives</p>
                        </div>
                    </div>
                </div>

                <!-- Security Notice -->
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <i class="fa-solid fa-shield-halved text-green-500"></i>
                    <p>Your information is secure and protected</p>
                </div>
            </section>

            <!-- Right: Order Summary -->
            <aside class="mt-10 lg:mt-0 lg:col-span-5">
                <div class="lg:sticky lg:top-6 space-y-6">

                    <div class="rounded-2xl border border-gray-200/70 bg-white/90 shadow-sm backdrop-blur p-6 sm:p-8">
                        <div class="mb-6 flex items-start gap-3">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-700">
                                <i class="fa-solid fa-receipt"></i>
                            </span>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Order Summary</h2>
                                <p class="text-sm text-gray-500">Review your order details</p>
                            </div>
                        </div>

                        <ul role="list" class="divide-y divide-gray-200 rounded-xl border border-gray-100 bg-white/70">
                            @forelse($cartItems as $item)
                                <li class="p-5 sm:p-6">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <p class="font-medium text-gray-900">
                                                {{ $item->name }}
                                                <span class="text-gray-500 font-normal">(x{{ (int)($item->quantity ?? 1) }})</span>
                                            </p>

                                            @if(($item->item_type ?? null) === 'SERVICE' && !empty($item->service_details))
                                                @php
                                                    $sd = is_array($item->service_details) ? $item->service_details : (array)$item->service_details;
                                                    $date = $sd['date'] ?? null;
                                                    $time = $sd['time'] ?? null;
                                                    $location = $sd['location'] ?? null;
                                                @endphp

                                                <div class="mt-3 grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm">
                                                    <div class="flex items-center gap-2 rounded-lg bg-gray-50 p-2.5">
                                                        <i class="fa-regular fa-calendar text-gray-500"></i>
                                                        <p class="text-gray-700">
                                                            <span class="text-gray-500">Date:</span>
                                                            <span class="font-medium">{{ $date ?: 'N/A' }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="flex items-center gap-2 rounded-lg bg-gray-50 p-2.5">
                                                        <i class="fa-regular fa-clock text-gray-500"></i>
                                                        <p class="text-gray-700">
                                                            <span class="text-gray-500">Time:</span>
                                                            <span class="font-medium">{{ $time ?: 'N/A' }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="flex items-center gap-2 rounded-lg bg-gray-50 p-2.5 sm:col-span-1">
                                                        <i class="fa-solid fa-location-dot text-gray-500"></i>
                                                        <p class="text-gray-700">
                                                            <span class="text-gray-500">Location:</span>
                                                            <span class="font-medium line-clamp-1" title="{{ $location ?: 'N/A' }}">{{ $location ?: 'N/A' }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        @if(isset($item->price))
                                            <div class="text-right">
                                                <p class="text-sm text-gray-500">Price</p>
                                                <p class="text-base font-semibold text-gray-900">₹{{ number_format((float)$item->price, 2) }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @empty
                                <li class="p-6">
                                    <p class="text-sm text-gray-500">Your cart is empty.</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-white/95 shadow-sm">
                        <div class="p-5 sm:p-6">
                            <dl class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <dt class="text-sm text-gray-600">Subtotal</dt>
                                    <dd class="text-sm font-medium text-gray-900">₹{{ number_format((float)($summary['subtotal'] ?? 0), 2) }}</dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="text-sm text-gray-600">Taxes (18% GST)</dt>
                                    <dd class="text-sm font-medium text-gray-900">₹{{ number_format((float)($summary['tax'] ?? 0), 2) }}</dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="text-sm text-gray-600">Shipping</dt>
                                    <dd class="text-sm font-medium text-gray-900">Free</dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-300 pt-4">
                                    <dt class="text-base font-semibold text-gray-900">Order total</dt>
                                    <dd class="text-base font-bold text-gray-900">₹{{ number_format((float)($summary['total'] ?? 0), 2) }}</dd>
                                </div>
                            </dl>

                            <button type="submit"
                                    class="mt-6 w-full rounded-xl bg-gray-900 px-6 py-4 text-base font-semibold text-white shadow-sm transition hover:bg-gray-800 hover:shadow-md focus:ring-2 focus:ring-gray-500/20 focus:outline-none">
                                <i class="fa-solid fa-circle-check mr-2"></i>
                                Place Order (COD)
                            </button>

                            <p class="mt-3 text-center text-xs text-gray-500">By placing the order, you agree to our Terms & Returns Policy.</p>
                        </div>
                    </div>

                </div>
            </aside>
        </form>
    </div>
</div>
@endsection
