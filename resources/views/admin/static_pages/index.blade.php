@extends('layouts.admin')
@section('title', 'Manage Static Pages')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Static Pages</h2>
        <a href="{{ route('admin.static-pages.create') }}" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Add New Page</a>
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead><tr><th>Title</th><th>Slug</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @foreach($pages as $page)
            <tr>
                <td>{{ $page->title }}</td>
                <td>/p/{{ $page->slug }}</td>
                <td>@if($page->is_published) Active @else Draft @endif</td>
                <td>
                    <a href="{{ route('admin.static-pages.edit', $page->id) }}">Edit</a>
                    <form action="{{ route('admin.static-pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
