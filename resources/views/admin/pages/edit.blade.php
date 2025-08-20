@extends('layouts.admin')
@section('title', $section ? 'Edit Homepage Section' : 'Add Custom Homepage Section')
@section('content')
<div class="bg-white p-6 sm:p-10 rounded-xl shadow-md max-w-2xl mx-auto mt-6">
    <form action="{{ $section ? route('admin.pages.update', $section->id) : route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($section) @method('POST') @endif
        @include('admin.pages._form', compact('section'))
    </form>
</div>
@endsection
