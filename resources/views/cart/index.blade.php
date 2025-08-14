@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-4xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">Shopping Cart</h1>

        <div class="mt-12">
            @if(count($cartItems) > 0)
            <section>
                <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                    <li class="flex py-6">
                        <div class="flex-shrink-0">
                            <img src="{{ $item->primary_image ?? 'https://placehold.co/150' }}" alt="{{ $item->name }}" class="w-24 h-24 rounded-md object-center object-cover sm:w-32 sm:h-32">
                        </div>

                        <div class="ml-4 flex-1 flex flex-col sm:ml-6">
                            <div>
                                <div class="flex justify-between">
                                    <h4 class="text-sm">
                                        <a href="{{ route('items.show', $item->slug) }}" class="font-medium text-gray-700 hover:text-gray-800">{{ $item->name }}</a>
                                    </h4>
                                    <p class="ml-4 text-sm font-medium text-gray-900">₹{{ number_format($item->total_price, 2) }}</p>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Unit Price: ₹{{ number_format($item->base_price, 2) }}</p>
                            </div>

                            <div class="mt-4 flex-1 flex items-end justify-between">
                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                    @csrf
                                    <label for="quantity-{{$item->id}}" class="sr-only">Quantity, {{ $item->name }}</label>
                                    <input type="number" id="quantity-{{$item->id}}" name="quantity" value="{{ $item->quantity }}" class="w-20 rounded border border-gray-300" min="1" onchange="this.form.submit()">
                                </form>

                                <div class="ml-4">
                                    <a href="{{ route('cart.remove', $item->id) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                        <span>Remove</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </section>

            <!-- Order summary -->
            <section class="mt-10">
                <div class="bg-gray-50 rounded-lg px-4 py-6 sm:p-6 lg:p-8">
                    <h2 class="text-xl font-medium text-gray-900">Order summary</h2>

                    <div class="flow-root mt-6">
                        <dl class="-my-4 text-sm divide-y divide-gray-200">
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-gray-600">Subtotal</dt>
                                <dd class="font-medium text-gray-900">₹{{ number_format($subTotal, 2) }}</dd>
                            </div>
                            <!-- Taxes and shipping can be added here -->
                            <div class="py-4 flex items-center justify-between">
                                <dt class="text-base font-medium text-gray-900">Order total</dt>
                                <dd class="text-base font-medium text-gray-900">₹{{ number_format($subTotal, 2) }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="mt-10">
                        <a href="{{ route('checkout.index') }}" class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">Checkout</a>
                    </div>
                </div>
            </section>
            @else
            <div class="text-center py-16 bg-gradient-to-br from-gray-50 via-white to-gray-100 rounded-lg shadow-sm">
                <!-- Custom SVG illustration: Shopping cart in subtle pastel tones -->
                <div class="mx-auto flex justify-center items-center pb-6">
                    <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto">
                        <rect width="120" height="120" rx="24" fill="#EEF2FF"/>
                        <path d="M32 40h56l-6 32H48l-8-32z" fill="#C7D2FE"/>
                        <ellipse cx="50" cy="80" rx="6" ry="6" fill="#A5B4FC"/>
                        <ellipse cx="86" cy="80" rx="6" ry="6" fill="#A5B4FC"/>
                        <rect x="40" y="48" width="44" height="8" rx="4" fill="#DBEAFE"/>
                    </svg>
                </div>
                <h2 class="mt-6 text-2xl font-semibold text-gray-900">Your cart is empty</h2>
                <p class="mt-2 text-base text-gray-500">
                    Looks like you haven't added anything yet.<br>
                    Find your favourites and start shopping!
                </p>
                <div class="mt-8">
                    <a href="{{ route('items.index') }}" class="inline-block px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow font-medium transition">
                        Continue Shopping<span aria-hidden="true"> &rarr;</span>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
