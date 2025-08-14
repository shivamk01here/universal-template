@extends('layouts.app')
@section('content')
<div class="flex items-center justify-center min-h-[60vh] bg-gray-50 py-12 px-4">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-lg shadow-md">
        <div><h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Set New Password</h2></div>
        <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="password" name="password" required placeholder="New Password" class="w-full px-3 py-2 border border-gray-300 rounded-md">
            <input type="password" name="password_confirmation" required placeholder="Confirm New Password" class="w-full px-3 py-2 border border-gray-300 rounded-md">
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Reset Password</button>
            </div>
        </form>
    </div>
</div>
@endsection