@extends('frontend.account.layout')

@section('account_content')
<div class="bg-white/70 backdrop-blur-sm shadow-sm border border-gray-200/50 rounded-xl overflow-hidden">
    <div class="px-8 py-8">
        <div class="flex items-center mb-2">
            <div class="flex-shrink-0">
                <i class="fas fa-history text-2xl text-gray-600"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-light text-gray-900">Order History</h3>
                <p class="mt-1 text-base text-gray-500">Track and review your recent purchases</p>
            </div>
        </div>
    </div>
    
    <div class="border-t border-gray-200/60 p-8">
        <div class="space-y-6">
            @forelse($orders as $order)
                <div class="bg-gray-50/60 backdrop-blur-sm border border-gray-200/40 rounded-xl p-6 hover:shadow-sm transition-all duration-200">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <i class="fas fa-receipt text-lg text-gray-500 mr-3"></i>
                                <h3 class="text-xl font-medium text-gray-900">Order #{{ $order->id }}</h3>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-calendar-alt text-gray-400 mr-2"></i>
                                    <span>Placed on {{ \Carbon\Carbon::parse($order->created_at)->format('F d, Y') }}</span>
                                </div>
                                <div class="flex items-center text-gray-900 font-medium">
                                    <i class="fas fa-rupee-sign text-gray-400 mr-2"></i>
                                    <span>Total: ₹{{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col items-end">
                            @php
                                $statusColors = [
                                    'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                                    'pending' => 'bg-amber-100 text-amber-800 border-amber-200',
                                    'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                    'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                    'shipped' => 'bg-purple-100 text-purple-800 border-purple-200'
                                ];
                                $statusIcons = [
                                    'completed' => 'fas fa-check-circle',
                                    'pending' => 'fas fa-clock',
                                    'processing' => 'fas fa-cog fa-spin',
                                    'cancelled' => 'fas fa-times-circle',
                                    'shipped' => 'fas fa-truck'
                                ];
                                $colorClass = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                $iconClass = $statusIcons[$order->status] ?? 'fas fa-info-circle';
                            @endphp
                            
                            <span class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-full border {{ $colorClass }}">
                                <i class="{{ $iconClass }} mr-2"></i>
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200/60 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-medium text-gray-900 flex items-center">
                                <i class="fas fa-box text-gray-500 mr-2"></i>
                                Order Items
                            </h4>
                            <span class="text-sm text-gray-500">{{ count($order->items) }} item{{ count($order->items) > 1 ? 's' : '' }}</span>
                        </div>
                        
                        <div class="bg-white/60 backdrop-blur-sm rounded-lg p-4 border border-gray-200/40">
                            <ul class="space-y-3">
                                @foreach($order->items as $item)
                                    <li class="flex items-center justify-between py-2 {{ !$loop->last ? 'border-b border-gray-200/40' : '' }}">
                                        <div class="flex items-center flex-1">
                                            <div class="flex-shrink-0 w-2 h-2 bg-gray-400 rounded-full mr-4"></div>
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-base font-medium text-gray-900">{{ $item->item_name }}</span>
                                                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                                                        <span class="bg-gray-100/80 px-3 py-1 rounded-full">Qty: {{ $item->quantity }}</span>
                                                        <span class="font-medium text-gray-900">₹{{ number_format($item->price, 2) }}</span>
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
                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200/60">
                        <div class="flex items-center text-sm text-gray-500">
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
                                <button class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors duration-200">
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
                        <i class="fas fa-shopping-bag text-4xl text-gray-300 mb-6"></i>
                        <h3 class="text-xl font-medium text-gray-900 mb-3">No orders yet</h3>
                        <p class="text-gray-500 mb-8">You haven't placed any orders yet. Start shopping to see your order history here.</p>
                        <a href="{{ route('items.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-900 to-gray-800 hover:from-gray-800 hover:to-gray-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
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
