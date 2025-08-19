@extends('layouts.admin')
@section('title', 'Add New Testimonial')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.testimonials._form', ['testimonial' => null])
    </form>
</div>
@endsection