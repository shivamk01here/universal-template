@extends('layouts.admin')
@section('title', 'Edit FAQ')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.faqs._form', ['faq' => $faq])
    </form>
</div>
@endsection