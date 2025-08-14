@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-8 sm:py-10">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-8 sm:mb-10 text-sm text-gray-500">
            <ol class="flex items-center gap-2">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-gray-700">Home</a>
                </li>
                <li>
                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                </li>
                <li>
                    <a href="{{ route('cart.index') }}" class="hover:text-gray-700">Cart</a>
                </li>
                <li>
                    <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
                </li>
                <li class="text-gray-900 font-medium">Checkout</li>
            </ol>
        </nav>

        <form action="{{ route('checkout.placeOrder') }}" method="POST" class="lg:grid lg:grid-cols-12 lg:gap-10">
            @csrf

            <!-- Contact & Shipping -->
            <section class="lg:col-span-7">
                <div class="rounded-xl border border-gray-200/60 bg-white/80 p-6 sm:p-8 shadow-sm backdrop-blur">
                    <div class="mb-6 flex items-start gap-3">
                        <i class="fa-solid fa-truck-fast text-xl text-gray-600"></i>
                        <div>
                            <h2 class="text-lg sm:text-xl font-medium text-gray-900">Shipping Information</h2>
                            <p class="text-sm text-gray-500">Please provide your delivery details</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700">Full Name</label>
                            <input id="name" name="name" type="text" required
                                   class="w-full rounded-lg border border-gray-300/70 bg-white/90 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20"
                                   value="{{ auth()->user()->name ?? '' }}"
                                   placeholder="Enter your full name">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">Email Address</label>
                            <input id="email" name="email" type="email" required
                                   class="w-full rounded-lg border border-gray-300/70 bg-white/90 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20"
                                   value="{{ auth()->user()->email ?? '' }}"
                                   placeholder="Enter your email">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="phone" class="mb-1.5 block text-sm font-medium text-gray-700">Phone Number</label>
                            <input id="phone" name="phone" type="tel" required
                                   class="w-full rounded-lg border border-gray-300/70 bg-white/90 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20"
                                   placeholder="Enter your phone number">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="address_line_1" class="mb-1.5 block text-sm font-medium text-gray-700">Address Line 1</label>
                            <input id="address_line_1" name="address_line_1" type="text" required
                                   class="w-full rounded-lg border border-gray-300/70 bg-white/90 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20"
                                   placeholder="Street address, P.O. box">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="address_line_2" class="mb-1.5 block text-sm font-medium text-gray-700">Address Line 2 <span class="text-gray-400">(Optional)</span></label>
                            <input id="address_line_2" name="address_line_2" type="text"
                                   class="w-full rounded-lg border border-gray-300/70 bg-white/90 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20"
                                   placeholder="Apartment, suite, etc.">
                        </div>

                        <div>
                            <label for="city" class="mb-1.5 block text-sm font-medium text-gray-700">City</label>
                            <input id="city" name="city" type="text" required
                                   class="w-full rounded-lg border border-gray-300/70 bg-white/90 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20"
                                   placeholder="Enter city">
                        </div>

                        <div>
                            <label for="state" class="mb-1.5 block text-sm font-medium text-gray-700">State / Province</label>
                            <input id="state" name="state" type="text" required
                                   class="w-full rounded-lg border border-gray-300/70 bg-white/90 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20"
                                   placeholder="Enter state">
                        </div>

                        <div class="sm:col-span-2">
                            <label for="pincode" class="mb-1.5 block text-sm font-medium text-gray-700">Postal Code</label>
                            <input id="pincode" name="pincode" type="text" required
                                   class="w-full rounded-lg border border-gray-300/70 bg-white/90 px-4 py-3 text-base shadow-sm focus:border-gray-500/70 focus:ring-2 focus:ring-gray-500/20"
                                   placeholder="Enter postal code">
                        </div>
                    </div>
                </div>
            </section>

            <!-- Order Summary -->
            <aside class="mt-10 lg:mt-0 lg:col-span-5">
                <div class="rounded-xl border border-gray-200/60 bg-white/80 p-6 sm:p-8 shadow-sm backdrop-blur lg:sticky lg:top-6">
                    <div class="mb-6 flex items-start gap-3">
                        <i class="fa-solid fa-receipt text-xl text-gray-600"></i>
                        <div>
                            <h2 class="text-lg sm:text-xl font-medium text-gray-900">Order Summary</h2>
                            <p class="text-sm text-gray-500">Review your order details</p>
                        </div>
                    </div>

                    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                        <div class="p-5 sm:p-6">
                            <dl class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <dt class="text-sm text-gray-600">Subtotal</dt>
                                    <dd class="text-sm font-medium text-gray-900">₹{{ number_format($summary['subtotal'], 2) }}</dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="text-sm text-gray-600">Taxes (18% GST)</dt>
                                    <dd class="text-sm font-medium text-gray-900">₹{{ number_format($summary['tax'], 2) }}</dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="text-sm text-gray-600">Shipping</dt>
                                    <dd class="text-sm font-medium text-gray-900">Free</dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-300 pt-4">
                                    <dt class="text-base font-medium text-gray-900">Order total</dt>
                                    <dd class="text-base font-semibold text-gray-900">₹{{ number_format($summary['total'], 2) }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="mt-6 sm:mt-8">
                        <div class="rounded-lg border border-blue-200/60 bg-blue-50/80 p-4 sm:p-5 backdrop-blur">
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-money-bill-wave text-blue-600 pt-0.5"></i>
                                <div>
                                    <h4 class="text-sm font-medium text-blue-900">Cash on Delivery</h4>
                                    <p class="text-xs text-blue-700">Pay when your order arrives</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                            class="mt-6 w-full rounded-lg bg-gray-900 px-6 py-4 text-base font-medium text-white shadow-sm transition hover:bg-gray-800 hover:shadow-md">
                        <i class="fa-solid fa-circle-check mr-2"></i>
                        Place Order (COD)
                    </button>

                    <!-- Security Notice -->
                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <div class="flex items-center justify-center text-center">
                            <i class="fa-solid fa-shield-halved mr-2 text-lg text-green-500"></i>
                            <p class="text-sm text-gray-500">Your information is secure and protected</p>
                        </div>
                    </div>
                </div>
            </aside>
        </form>
    </div>
</div>
@endsection
