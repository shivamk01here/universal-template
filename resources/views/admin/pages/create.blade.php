@extends('layouts.admin')
@section('title', 'Add Custom Homepage Section')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.pages.store') }}" method="POST">
        @csrf
        @include('admin.pages._form', ['section' => null])
    </form>
</div>
@endsection