@extends('layouts.admin')
@section('title', 'Create New Item')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.items._form', ['item' => null])
        <div class="mt-8">
            <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Create Item</button>
            <a href="{{ route('admin.items.index') }}" class="ml-4 text-gray-600">Cancel</a>
        </div>
    </form>
</div>
@endsection