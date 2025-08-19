@extends('frontend.account.layout')

@section('account_content')
<div class="theme-bg-primary/70 backdrop-blur-sm shadow-sm theme-border border rounded-xl overflow-hidden">
    <div class="px-8 py-8">
        <div class="flex items-center mb-2">
            <div class="flex-shrink-0">
                <i class="fas fa-history text-2xl theme-text-secondary"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-light theme-text-primary">Order History</h3>
                <p class="mt-1 text-base theme-text-muted">Track and review your recent purchases</p>
            </div>
        </div>
    </div>
    
    <div class="theme-border border-t p-8">
        <div class="space-y-6">
            @forelse($orders as $order)
                <div class="theme-bg-tertiary/60 backdrop-blur-sm theme-border border rounded-xl p-6 hover:shadow-sm transition-all duration-200">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <i class="fas fa-receipt text-lg theme-text-muted mr-3"></i>
                                <h3 class="text-xl font-medium theme-text-primary">Order #{{ $order->id }}</h3>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                <div class="flex items-center theme-text-secondary">
                                    <i class="fas fa-calendar-alt theme-text-muted mr-2"></i>
                                    <span>Placed on {{ \Carbon\Carbon::parse($order->created_at)->format('F d, Y') }}</span>
                                </div>
                                <div class="flex items-center theme-text-primary font-medium">
                                    <i class="fas fa-rupee-sign theme-text-muted mr-2"></i>
                                    <span>Total: ₹{{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col items-end">
                            @php
                                $statusColors = [
                                    'completed'  => 'bg-emerald-100 text-emerald-800 border-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-300 dark:border-emerald-700/70',
                                    'pending'    => 'bg-amber-100 text-amber-800 border-amber-200 dark:bg-amber-900/25 dark:text-amber-200 dark:border-amber-600/60',
                                    'processing' => 'bg-blue-100 text-blue-800 border-blue-200 dark:bg-blue-900/20 dark:text-blue-300 dark:border-blue-700/70',
                                    'cancelled'  => 'bg-red-100 text-red-800 border-red-200 dark:bg-red-900/20 dark:text-red-300 dark:border-red-700/70',
                                    'shipped'    => 'bg-purple-100 text-purple-800 border-purple-200 dark:bg-purple-900/20 dark:text-purple-200 dark:border-purple-700/70'
                                ];
                                $statusIcons = [
                                    'completed'  => 'fas fa-check-circle',
                                    'pending'    => 'fas fa-clock',
                                    'processing' => 'fas fa-cog fa-spin',
                                    'cancelled'  => 'fas fa-times-circle',
                                    'shipped'    => 'fas fa-truck'
                                ];
                                $colorClass = $statusColors[$order->status] ?? 'theme-bg-secondary theme-text-secondary theme-border';
                                $iconClass  = $statusIcons[$order->status] ?? 'fas fa-info-circle';
                            @endphp
                            
                            <span class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-full border {{ $colorClass }}">
                                <i class="{{ $iconClass }} mr-2"></i>
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="theme-border border-t pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-medium theme-text-primary flex items-center">
                                <i class="fas fa-box theme-text-muted mr-2"></i>
                                Order Items
                            </h4>
                            <span class="text-sm theme-text-muted">{{ count($order->items) }} item{{ count($order->items) > 1 ? 's' : '' }}</span>
                        </div>
                        
                        <div class="theme-bg-primary/60 backdrop-blur-sm rounded-lg p-4 theme-border border">
                            <ul class="space-y-3">
                                @foreach($order->items as $item)
                                    <li class="flex items-center justify-between py-2 {{ !$loop->last ? 'theme-border border-b' : '' }}">
                                        <div class="flex items-center flex-1">
                                            <div class="flex-shrink-0 w-2 h-2 bg-primary-dynamic rounded-full mr-4"></div>
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-base font-medium theme-text-primary">{{ $item->item_name }}</span>
                                                    <div class="flex items-center space-x-4 text-sm theme-text-secondary">
                                                        <span class="theme-bg-tertiary/80 px-3 py-1 rounded-full">Qty: {{ $item->quantity }}</span>
                                                        <span class="font-medium theme-text-primary">₹{{ number_format($item->price, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Order Actions -->
                    <div class="flex items-center justify-between mt-6 pt-4 theme-border border-t">
                        <div class="flex items-center text-sm theme-text-muted">
                            <i class="fas fa-truck mr-2"></i>
                            <span>
                                @if($order->status == 'completed')
                                    Order delivered
                                @elseif($order->status == 'shipped')
                                    Order shipped
                                @elseif($order->status == 'processing')
                                    Being prepared
                                @else
                                    Order {{ $order->status }}
                                @endif
                            </span>
                        </div>
                        
                        @if($order->status != 'cancelled')
                            <div class="flex space-x-3">
                                @if(in_array($order->status, ['pending', 'processing']))
                                    <button class="text-sm font-medium text-red-600 hover:text-red-700 transition-colors duration-200">
                                        <i class="fas fa-times mr-1"></i>
                                        Cancel Order
                                    </button>
                                @endif
                                <button class="text-sm font-medium theme-text-secondary hover:theme-text-primary transition-colors duration-200">
                                    <i class="fas fa-eye mr-1"></i>
                                    View Details
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-shopping-bag text-4xl theme-text-muted mb-6"></i>
                        <h3 class="text-xl font-medium theme-text-primary mb-3">No orders yet</h3>
                        <p class="theme-text-muted mb-8">You haven't placed any orders yet. Start shopping to see your order history here.</p>
                        <a href="{{ route('items.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary-dynamic to-secondary-dynamic hover:from-secondary-dynamic hover:to-primary-dynamic text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Start Shopping
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
