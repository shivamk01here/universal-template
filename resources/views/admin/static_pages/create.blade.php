@extends('layouts.admin')
@section('title', 'Create New Page')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.static-pages.store') }}" method="POST">
        @csrf
        @include('admin.static_pages._form', ['page' => null])
    </form>
</div>
@endsection