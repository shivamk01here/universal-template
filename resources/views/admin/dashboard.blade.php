@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-500 bg-opacity-20 text-blue-500">
                <i class="fas fa-users fa-2x"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600">Total Users</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['users'] }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-500 bg-opacity-20 text-green-500">
                <i class="fas fa-shopping-cart fa-2x"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600">Total Orders</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['orders'] }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-500 bg-opacity-20 text-yellow-500">
                <i class="fas fa-box-open fa-2x"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600">Total Items</p>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['items'] }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-500 bg-opacity-20 text-red-500">
                <i class="fas fa-rupee-sign fa-2x"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-600">Total Revenue</p>
                <p class="text-2xl font-bold text-gray-900">₹{{ number_format($stats['revenue'], 2) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection