@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen pt-6 pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <div class="mb-12">
            <nav class="flex items-center space-x-2 text-sm text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-gray-700 transition-colors">Home</a>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                <a href="{{ route('cart.index') }}" class="hover:text-gray-700 transition-colors">Cart</a>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                <a href="{{ route('checkout.index') }}" class="hover:text-gray-700 transition-colors">Checkout</a>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                <span class="text-gray-900 font-medium">Order Confirmation</span>
            </nav>
        </div>

        <div class="flex items-center justify-center min-h-[60vh]">
            <div class="w-full max-w-2xl">
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-200/50 p-12 text-center">
                    <!-- Success Icon -->
                    <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-r from-emerald-100 to-green-100 mb-8">
                        <i class="fas fa-check text-3xl text-emerald-600"></i>
                    </div>

                    <!-- Success Message -->
                    <h2 class="text-3xl font-light text-gray-900 mb-4">Order Placed Successfully!</h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed max-w-lg mx-auto">
                        Thank you for your purchase. You will receive a confirmation email shortly with your order details.
                    </p>

                    <!-- Order Details Card -->
                    <div class="bg-gray-50/60 backdrop-blur-sm rounded-xl p-6 mb-10 border border-gray-200/40">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                            <div>
                                <div class="flex items-center justify-center mb-2">
                                    <i class="fas fa-truck text-blue-500 text-xl"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-900">Free Delivery</h4>
                                <p class="text-xs text-gray-500 mt-1">Within 3-5 business days</p>
                            </div>
                            <div>
                                <div class="flex items-center justify-center mb-2">
                                    <i class="fas fa-money-bill-wave text-amber-500 text-xl"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-900">Cash on Delivery</h4>
                                <p class="text-xs text-gray-500 mt-1">Pay when you receive</p>
                            </div>
                            <div>
                                <div class="flex items-center justify-center mb-2">
                                    <i class="fas fa-headset text-purple-500 text-xl"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-900">Support</h4>
                                <p class="text-xs text-gray-500 mt-1">24/7 customer service</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('home') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-gray-900 to-gray-800 hover:from-gray-800 hover:to-gray-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-home mr-2"></i>
                            Continue Shopping
                        </a>
                        <a href="{{ route('items.index') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 bg-gray-100/80 hover:bg-gray-200/80 text-gray-700 hover:text-gray-900 font-medium rounded-lg transition-all duration-200">
                            <i class="fas fa-th-large mr-2"></i>
                            Browse Items
                        </a>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-10 pt-8 border-t border-gray-200/60">
                        <div class="flex items-center justify-center text-center">
                            <i class="fas fa-envelope text-gray-400 text-lg mr-3"></i>
                            <p class="text-sm text-gray-500">
                                Questions about your order? 
                                <a href="mailto:support@example.com" class="text-gray-700 hover:text-gray-900 font-medium underline ml-1">Contact Support</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Decorative Elements -->
                <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none">
                    <div class="absolute top-20 left-10 w-20 h-20 bg-emerald-200/20 rounded-full blur-xl"></div>
                    <div class="absolute bottom-32 right-16 w-32 h-32 bg-blue-200/20 rounded-full blur-xl"></div>
                    <div class="absolute top-40 right-20 w-16 h-16 bg-amber-200/20 rounded-full blur-xl"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
