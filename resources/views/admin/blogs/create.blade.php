@extends('layouts.admin')
@section('title', 'Create New Blog Post')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.blogs.store') }}" method="POST">
        @csrf
        @include('admin.blogs._form', ['blog' => null])
    </form>
</div>
@endsection