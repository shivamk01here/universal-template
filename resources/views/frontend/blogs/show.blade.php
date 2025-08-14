@extends('layouts.app')
@section('content')
<div class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose lg:prose-xl mx-auto">
            <h1><b>{{ $blog->title }}</b></h1>
            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}</p>
            @if($blog->image_url)
                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="w-full rounded-lg my-8">
            @endif
            {!! $blog->content !!}
        </div>
    </div>
</div>
@endsection