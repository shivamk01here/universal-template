@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center min-h-[60vh] bg-gray-50 py-12 px-4">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-lg shadow-md">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Reset Password</h2>
            <p class="mt-2 text-center text-sm text-gray-600">Enter your email address and we will send you a link to reset your password.</p>
        </div>
        <form class="mt-8 space-y-6" action="{{ route('password.email') }}" method="POST">
            @csrf
            <input type="email" name="email" required placeholder="Email Address" class="w-full px-3 py-2 border border-gray-300 rounded-md">
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Send Password Reset Link</button>
            </div>
        </form>
    </div>
</div>
@endsection