<!-- resources/views/frontend/page.blade.php (NEW) -->
@extends('layouts.app')
@section('title', $page->title)
@section('content')
            {!! $page->content !!}
@endsection
