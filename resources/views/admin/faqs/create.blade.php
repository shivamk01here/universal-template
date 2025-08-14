@extends('layouts.admin')
@section('title', 'Create New FAQ')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        @include('admin.faqs._form', ['faq' => null])
    </form>
</div>
@endsection