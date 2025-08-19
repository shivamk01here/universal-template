@extends('layouts.app')

@section('content')
<div class="theme-gradient-account min-h-screen pt-6 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <div class="mb-12">
            <nav class="flex items-center space-x-2 text-sm theme-text-muted">
                <a href="{{ route('home') }}" class="hover:theme-text-primary transition-colors">Home</a>
                <i class="fas fa-chevron-right text-xs theme-text-muted/70"></i>
                <span class="theme-text-primary font-medium">My Account</span>
            </nav>
        </div>

        <!-- Page Header -->
        <div class="mb-12">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 rounded-full bg-gradient-to-r from-primary-dynamic to-secondary-dynamic flex items-center justify-center shadow-sm">
                        <i class="fas fa-user text-white text-lg"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h1 class="text-3xl font-light theme-text-primary">My Account</h1>
                    <p class="text-base theme-text-muted">Manage your profile and view your orders</p>
                </div>
            </div>
        </div>

        <div class="lg:grid lg:grid-cols-12 lg:gap-x-8">
            <!-- Sidebar Navigation -->
            <aside class="lg:col-span-3 mb-8 lg:mb-0">
                <div class="theme-bg-primary/70 backdrop-blur-sm rounded-xl shadow-sm theme-border border p-6 sticky top-8">
                    <nav class="space-y-2">
                        <!-- Profile Settings link -->
                        <a href="{{ route('account.profile') }}" 
                           class="{{ request()->routeIs('account.profile') ? 'theme-bg-secondary theme-text-primary shadow-sm' : 'theme-text-muted hover:theme-bg-tertiary/80 hover:theme-text-primary' }} group rounded-lg px-4 py-4 flex items-center text-base font-medium transition-all duration-200">
                            <i class="fas fa-user-edit mr-4 text-lg {{ request()->routeIs('account.profile') ? 'theme-text-primary' : 'theme-text-muted group-hover:theme-text-secondary' }}"></i>
                            <span class="truncate">Profile Settings</span>
                            @if(request()->routeIs('account.profile'))
                                <i class="fas fa-chevron-right ml-auto text-sm"></i>
                            @endif
                        </a>
                        <!-- Order History link -->
                        <a href="{{ route('account.orders') }}" 
                           class="{{ request()->routeIs('account.orders') ? 'theme-bg-secondary theme-text-primary shadow-sm' : 'theme-text-muted hover:theme-bg-tertiary/80 hover:theme-text-primary' }} group rounded-lg px-4 py-4 flex items-center text-base font-medium transition-all duration-200">
                            <i class="fas fa-history mr-4 text-lg {{ request()->routeIs('account.orders') ? 'theme-text-primary' : 'theme-text-muted group-hover:theme-text-secondary' }}"></i>
                            <span class="truncate">Order History</span>
                            @if(request()->routeIs('account.orders'))
                                <i class="fas fa-chevron-right ml-auto text-sm"></i>
                            @endif
                        </a>
                    </nav>

                    <!-- Account Summary -->
                    <div class="mt-8 pt-6 theme-border border-t">
                        <div class="text-center">
                            <div class="text-sm theme-text-muted mb-2">Logged in as</div>
                            <div class="font-medium theme-text-primary truncate">{{ auth()->user()->name ?? 'User' }}</div>
                            <div class="text-sm theme-text-muted truncate">{{ auth()->user()->email ?? '' }}</div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mt-6 pt-6 theme-border border-t">
                        <div class="space-y-3">
                            <a href="{{ route('cart.index') }}" 
                               class="w-full flex items-center justify-center px-4 py-3 theme-bg-tertiary/80 hover:theme-bg-secondary/80 theme-text-secondary hover:theme-text-primary font-medium rounded-lg transition-all duration-200 text-sm">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                View Cart
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" 
                                        class="w-full flex items-center justify-center px-4 py-3 bg-red-100/80 hover:bg-red-200/80 text-red-600 hover:text-red-700 font-medium rounded-lg transition-all duration-200 text-sm">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="lg:col-span-9">
                <div class="space-y-8">
                    @yield('account_content')
                </div>
            </div>
        </div>
    </div>
</div>
<style>
/* For theme gradients and backgrounds */
.theme-gradient-account {
    background: linear-gradient(to bottom, var(--theme-tertiary, #f9fafb), var(--theme-primary, #ffffff));
}
[data-theme="dark"] .theme-gradient-account {
    background: linear-gradient(to bottom, var(--theme-secondary, #1f2937), var(--theme-tertiary, #111827));
}
</style>
@endsection
