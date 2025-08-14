<!-- resources/views/frontend/account/layout.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white min-h-screen pt-6 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <div class="mb-12">
            <nav class="flex items-center space-x-2 text-sm text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-gray-700 transition-colors">Home</a>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                <span class="text-gray-900 font-medium">My Account</span>
            </nav>
        </div>

        <!-- Page Header -->
        <div class="mb-12">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 rounded-full bg-gradient-to-r from-gray-600 to-gray-700 flex items-center justify-center shadow-sm">
                        <i class="fas fa-user text-white text-lg"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h1 class="text-3xl font-light text-gray-900">My Account</h1>
                    <p class="text-base text-gray-500">Manage your profile and view your orders</p>
                </div>
            </div>
        </div>

        <div class="lg:grid lg:grid-cols-12 lg:gap-x-8">
            <!-- Sidebar Navigation -->
            <aside class="lg:col-span-3 mb-8 lg:mb-0">
                <div class="bg-white/70 backdrop-blur-sm rounded-xl shadow-sm border border-gray-200/50 p-6 sticky top-8">
                    <nav class="space-y-2">
                        <a href="{{ route('account.profile') }}" 
                           class="{{ request()->routeIs('account.profile') ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }} group rounded-lg px-4 py-4 flex items-center text-base font-medium transition-all duration-200">
                            <i class="fas fa-user-edit mr-4 text-lg {{ request()->routeIs('account.profile') ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                            <span class="truncate">Profile Settings</span>
                            @if(request()->routeIs('account.profile'))
                                <i class="fas fa-chevron-right ml-auto text-sm"></i>
                            @endif
                        </a>
                        
                        <a href="{{ route('account.orders') }}" 
                           class="{{ request()->routeIs('account.orders') ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100/80 hover:text-gray-900' }} group rounded-lg px-4 py-4 flex items-center text-base font-medium transition-all duration-200">
                            <i class="fas fa-history mr-4 text-lg {{ request()->routeIs('account.orders') ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                            <span class="truncate">Order History</span>
                            @if(request()->routeIs('account.orders'))
                                <i class="fas fa-chevron-right ml-auto text-sm"></i>
                            @endif
                        </a>
                    </nav>

                    <!-- Account Summary -->
                    <div class="mt-8 pt-6 border-t border-gray-200/60">
                        <div class="text-center">
                            <div class="text-sm text-gray-500 mb-2">Logged in as</div>
                            <div class="font-medium text-gray-900 truncate">{{ auth()->user()->name ?? 'User' }}</div>
                            <div class="text-sm text-gray-500 truncate">{{ auth()->user()->email ?? '' }}</div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mt-6 pt-6 border-t border-gray-200/60">
                        <div class="space-y-3">
                            <a href="{{ route('cart.index') }}" 
                               class="w-full flex items-center justify-center px-4 py-3 bg-gray-100/80 hover:bg-gray-200/80 text-gray-700 hover:text-gray-900 font-medium rounded-lg transition-all duration-200 text-sm">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                View Cart
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" 
                                        class="w-full flex items-center justify-center px-4 py-3 bg-red-50/80 hover:bg-red-100/80 text-red-600 hover:text-red-700 font-medium rounded-lg transition-all duration-200 text-sm">
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
@endsection
