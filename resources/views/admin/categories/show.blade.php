@extends('layouts.admin')
@section('title', 'View Category')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">{{ $category->name }}</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Edit</a>
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-700">Back to List</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="font-semibold text-lg mb-4">Category Details</h3>
            
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <p class="text-gray-900">{{ $category->name }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Slug</label>
                    <p class="text-gray-900">{{ $category->slug }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Parent Category</label>
                    <p class="text-gray-900">{{ $parent ? $parent->name : 'Main Category' }}</p>
                </div>
                
                @if($category->description)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <p class="text-gray-900">{{ $category->description }}</p>
                </div>
                @endif
            </div>
        </div>

        <div>
            @if($category->image_url)
                <h3 class="font-semibold text-lg mb-4">Category Image</h3>
                <img src="{{ asset('storage/' . $category->image_url) }}" alt="{{ $category->name }}" class="max-w-full h-auto rounded-lg">
            @endif
        </div>
    </div>

    @if(count($children) > 0)
    <div class="mt-8">
        <h3 class="font-semibold text-lg mb-4">Subcategories ({{ count($children) }})</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($children as $child)
                <div class="border p-4 rounded-lg">
                    <h4 class="font-medium">{{ $child->name }}</h4>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="mt-8">
        <h3 class="font-semibold text-lg mb-4">Items in this Category ({{ count($items) }})</h3>
        @if(count($items) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($items as $item)
                    <div class="border p-4 rounded-lg">
                        <h4 class="font-medium">{{ $item->name }}</h4>
                        <p class="text-sm text-gray-600">₹{{ number_format($item->base_price, 2) }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No items in this category yet.</p>
        @endif
    </div>
</div>
@endsection
