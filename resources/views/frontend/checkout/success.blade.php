@extends('layouts.app')

@section('content')
<div class="theme-gradient-primary min-h-screen pt-6 pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <div class="mb-12">
            <nav class="flex items-center space-x-2 text-sm theme-text-muted">
                <a href="{{ route('home') }}" class="hover:theme-text-primary transition-colors">Home</a>
                <i class="fas fa-chevron-right text-xs theme-text-muted/60"></i>
                <a href="{{ route('cart.index') }}" class="hover:theme-text-primary transition-colors">Cart</a>
                <i class="fas fa-chevron-right text-xs theme-text-muted/60"></i>
                <a href="{{ route('checkout.index') }}" class="hover:theme-text-primary transition-colors">Checkout</a>
                <i class="fas fa-chevron-right text-xs theme-text-muted/60"></i>
                <span class="theme-text-primary font-medium">Order Confirmation</span>
            </nav>
        </div>

        <div class="flex items-center justify-center min-h-[60vh]">
            <div class="w-full max-w-2xl relative">
                <div class="theme-bg-primary/80 backdrop-blur-sm rounded-2xl shadow-sm theme-border border p-8 sm:p-12 text-center">
                    <!-- Success Icon -->
                    <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gradient-to-r from-emerald-100/70 to-green-100/80 dark:from-emerald-900/20 dark:to-emerald-800/30 mb-8">
                        <i class="fas fa-check text-3xl text-emerald-600 dark:text-emerald-400"></i>
                    </div>
                    <!-- Success Message -->
                    <h2 class="text-3xl font-light theme-text-primary mb-4">Order Placed Successfully!</h2>
                    <p class="text-lg theme-text-secondary mb-8 leading-relaxed max-w-lg mx-auto">
                        Thank you for your purchase. You will receive a confirmation email shortly with your order details.
                    </p>
                    <!-- Order Details Card -->
                    <div class="theme-bg-tertiary/70 backdrop-blur-sm rounded-xl p-6 mb-10 theme-border border">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                            <div>
                                <div class="flex items-center justify-center mb-2">
                                    <i class="fas fa-truck text-blue-500 dark:text-blue-400 text-xl"></i>
                                </div>
                                <h4 class="text-sm font-medium theme-text-primary">Free Delivery</h4>
                                <p class="text-xs theme-text-muted mt-1">Within 3-5 business days</p>
                            </div>
                            <div>
                                <div class="flex items-center justify-center mb-2">
                                    <i class="fas fa-money-bill-wave text-amber-500 dark:text-amber-300 text-xl"></i>
                                </div>
                                <h4 class="text-sm font-medium theme-text-primary">Cash on Delivery</h4>
                                <p class="text-xs theme-text-muted mt-1">Pay when you receive</p>
                            </div>
                            <div>
                                <div class="flex items-center justify-center mb-2">
                                    <i class="fas fa-headset text-purple-500 dark:text-purple-300 text-xl"></i>
                                </div>
                                <h4 class="text-sm font-medium theme-text-primary">Support</h4>
                                <p class="text-xs theme-text-muted mt-1">24/7 customer service</p>
                            </div>
                        </div>
                    </div>
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('home') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 bg-button-dynamic hover:opacity-90 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-home mr-2"></i>
                            Continue Shopping
                        </a>
                        <a href="{{ route('items.index') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 theme-bg-tertiary/80 hover:theme-bg-secondary/80 theme-text-secondary hover:theme-text-primary font-medium rounded-lg transition-all duration-200">
                            <i class="fas fa-th-large mr-2"></i>
                            Browse Items
                        </a>
                    </div>
                    <!-- Additional Info -->
                    <div class="mt-10 pt-8 theme-border border-t">
                        <div class="flex items-center justify-center text-center">
                            <i class="fas fa-envelope theme-text-muted text-lg mr-3"></i>
                            <p class="text-sm theme-text-muted">
                                Questions about your order? 
                                <a href="mailto:support@example.com" class="theme-text-primary hover:theme-text-secondary font-medium underline ml-1">Contact Support</a>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Decorative Elements -->
                <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none">
                    <div class="absolute top-20 left-10 w-20 h-20 bg-emerald-200/20 dark:bg-emerald-900/20 rounded-full blur-xl"></div>
                    <div class="absolute bottom-32 right-16 w-32 h-32 bg-blue-200/20 dark:bg-blue-900/20 rounded-full blur-xl"></div>
                    <div class="absolute top-40 right-20 w-16 h-16 bg-amber-200/20 dark:bg-amber-900/30 rounded-full blur-xl"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
.theme-gradient-primary {
    background: linear-gradient(to bottom, var(--theme-tertiary, #f9fafb), var(--theme-primary, #fff));
}
[data-theme="dark"] .theme-gradient-primary {
    background: linear-gradient(to bottom, var(--theme-secondary, #1f2937), var(--theme-primary, #111827));
}
</style>
