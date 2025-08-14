@extends('layouts.admin')
@section('title', 'Edit Blog Post')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.blogs._form', ['blog' => $blog])
    </form>
</div>
@endsection