@extends('layouts.admin')
@section('title', 'Manage Homepage Sections')
@section('content')
<div class="bg-white p-4 sm:p-8 rounded-xl shadow-md">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3">
        <h2 class="text-2xl font-bold text-gray-800">Homepage Sections</h2>
        <a href="{{ route('admin.pages.create') }}" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">Add Custom Section</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="sectionsTable">
            <thead>
                <tr>
                    <th class="px-2 py-2 sm:px-6 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                    <th class="px-2 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                    <th class="px-2 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase">Section Title</th>
                    <th class="px-2 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-2 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-2 sm:px-6 py-2 sm:py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="sortableSections">
            @foreach($sections as $section)
                <tr data-id="{{ $section->id }}" class="hover:bg-gray-50 cursor-grab transition-all">
                    <td class="px-2 sm:px-6 py-2 whitespace-nowrap">
                        @if($section->image)
                            <img src="{{ asset('storage/'.$section->image) }}" class="h-10 w-10 object-cover rounded bg-gray-100" />
                        @endif
                    </td>
                    <td class="px-2 sm:px-6 py-2 whitespace-nowrap text-sm text-gray-900 font-mono">{{ $section->sort_order }}</td>
                    <td class="px-2 sm:px-6 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ $section->title }}</td>
                    <td class="px-2 sm:px-6 py-2 whitespace-nowrap text-sm text-gray-600">{{ ucwords(str_replace('-', ' ', $section->section_type)) }}</td>
                    <td class="px-2 sm:px-6 py-2 whitespace-nowrap text-sm">
                        @if($section->is_active)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                        @endif
                    </td>
                    <td class="px-2 sm:px-6 py-2 whitespace-nowrap text-right text-sm font-medium space-x-2">
                        <a href="{{ route('admin.pages.edit', $section->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('admin.pages.destroy', $section->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this section?');">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p class="text-sm text-gray-400 mt-2 ml-1">Drag and drop rows to reorder sections.</p>
    </div>
</div>
<!-- SortableJS for drag-and-drop sorting -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sortable = new Sortable(document.getElementById('sortableSections'), {
        animation: 150,
        handle: 'tr',
        direction: 'vertical',
        onEnd: function () {
            const ids = Array.from(document.querySelectorAll('#sortableSections tr')).map(tr => tr.getAttribute('data-id'));
            fetch("{{ route('admin.pages.order') }}", {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                body: JSON.stringify({ order: ids })
            }).then(resp => resp.ok && location.reload());
        }
    });
});
</script>
@endsection
