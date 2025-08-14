@extends('frontend.account.layout')

@section('account_content')
<div class="bg-white/70 backdrop-blur-sm shadow-sm border border-gray-200/50 rounded-xl overflow-hidden">
    <div class="px-8 py-8">
        <div class="flex items-center mb-2">
            <div class="flex-shrink-0">
                <i class="fas fa-user-edit text-2xl text-gray-600"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-light text-gray-900">Personal Information</h3>
                <p class="mt-1 text-base text-gray-500">Update your personal details and password here.</p>
            </div>
        </div>
    </div>
    
    <div class="border-t border-gray-200/60">
        <form action="{{ route('account.profile.update') }}" method="POST">
            @csrf
            <div class="p-8 space-y-8">
                <!-- Personal Details Section -->
                <div class="space-y-6">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-id-card text-lg text-gray-500 mr-3"></i>
                        <h4 class="text-lg font-medium text-gray-900">Basic Information</h4>
                    </div>
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name', $user->name) }}" 
                               class="w-full px-4 py-3 text-base border border-gray-300/60 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-500/20 focus:border-gray-500/60 transition-all duration-200 bg-white/80">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   class="w-full px-4 py-3 text-base border border-gray-300/60 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-500/20 focus:border-gray-500/60 transition-all duration-200 bg-white/80 pl-12">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="pt-8 border-t border-gray-200/60">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-lock text-lg text-gray-500 mr-3"></i>
                        <div>
                            <h4 class="text-lg font-medium text-gray-900">Change Password</h4>
                            <p class="text-sm text-gray-500">Leave blank if you don't want to change your password</p>
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <div class="relative">
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       class="w-full px-4 py-3 text-base border border-gray-300/60 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-500/20 focus:border-gray-500/60 transition-all duration-200 bg-white/80 pl-12"
                                       placeholder="Enter new password">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-key text-gray-400"></i>
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Password should be at least 8 characters long</p>
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                            <div class="relative">
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       class="w-full px-4 py-3 text-base border border-gray-300/60 rounded-lg shadow-sm focus:ring-2 focus:ring-gray-500/20 focus:border-gray-500/60 transition-all duration-200 bg-white/80 pl-12"
                                       placeholder="Confirm new password">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-shield-alt text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Area -->
            <div class="px-8 py-6 bg-gray-50/60 backdrop-blur-sm border-t border-gray-200/60">
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span>Changes will be saved immediately</span>
                    </div>
                    <div class="flex space-x-4">
                        <button type="button" 
                                class="px-6 py-3 bg-gray-100/80 hover:bg-gray-200/80 text-gray-700 hover:text-gray-900 font-medium rounded-lg transition-all duration-200"
                                onclick="window.location.reload()">
                            <i class="fas fa-undo mr-2"></i>
                            Reset
                        </button>
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-gray-900 to-gray-800 hover:from-gray-800 hover:to-gray-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-save mr-2"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Security Notice -->
    <div class="px-8 py-4 bg-blue-50/60 backdrop-blur-sm border-t border-blue-200/40">
        <div class="flex items-center">
            <i class="fas fa-shield-alt text-blue-500 mr-3"></i>
            <div>
                <p class="text-sm font-medium text-blue-900">Your information is secure</p>
                <p class="text-xs text-blue-700">We use industry-standard encryption to protect your data</p>
            </div>
        </div>
    </div>
</div>
@endsection
