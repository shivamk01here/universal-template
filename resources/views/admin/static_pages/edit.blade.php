@extends('layouts.admin')
@section('title', 'Edit Page')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.static-pages.update', $page->id) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.static_pages._form', ['page' => $page])
    </form>
</div>
@endsection