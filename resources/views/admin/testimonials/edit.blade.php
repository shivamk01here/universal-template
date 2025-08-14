@extends('layouts.admin')
@section('title', 'Edit Testimonial')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.testimonials._form', ['testimonial' => $testimonial])
    </form>
</div>
@endsection
