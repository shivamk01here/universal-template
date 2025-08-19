@extends('frontend.account.layout')

@section('account_content')
<div class="theme-bg-primary/70 backdrop-blur-sm shadow-sm theme-border border rounded-xl overflow-hidden">
    <div class="px-8 py-8">
        <div class="flex items-center mb-2">
            <div class="flex-shrink-0">
                <i class="fas fa-user-edit text-2xl theme-text-secondary"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-light theme-text-primary">Personal Information</h3>
                <p class="mt-1 text-base theme-text-muted">Update your personal details and password here.</p>
            </div>
        </div>
    </div>
    
    <div class="theme-border border-t">
        <form action="{{ route('account.profile.update') }}" method="POST">
            @csrf
            <div class="p-8 space-y-8">
                <!-- Personal Details Section -->
                <div class="space-y-6">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-id-card text-lg theme-text-muted mr-3"></i>
                        <h4 class="text-lg font-medium theme-text-primary">Basic Information</h4>
                    </div>
                    
                    <div>
                        <label for="name" class="block text-sm font-medium theme-text-secondary mb-2">Full Name</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name', $user->name) }}" 
                               class="w-full px-4 py-3 text-base rounded-lg shadow-sm transition-all duration-200
                                      theme-text-primary theme-border border
                                      theme-bg-primary/80 dark:bg-gray-900/80 dark:text-gray-100
                                      focus:ring-2 focus:ring-primary-dynamic/20 focus:border-primary-dynamic/60
                                      placeholder-theme-text-muted dark:placeholder-gray-400"
                               placeholder="Your Full Name">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium theme-text-secondary mb-2">Email Address</label>
                        <div class="relative">
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   class="w-full px-4 py-3 text-base rounded-lg shadow-sm transition-all duration-200
                                          theme-text-primary theme-border border
                                          theme-bg-primary/80 dark:bg-gray-900/80 dark:text-gray-100
                                          focus:ring-2 focus:ring-primary-dynamic/20 focus:border-primary-dynamic/60
                                          pl-12 placeholder-theme-text-muted dark:placeholder-gray-400"
                                   placeholder="youremail@example.com">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope theme-text-muted dark:text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password Section -->
                <div class="pt-8 theme-border border-t">
                    <div class="flex items-center mb-6">
                        <i class="fas fa-lock text-lg theme-text-muted mr-3"></i>
                        <div>
                            <h4 class="text-lg font-medium theme-text-primary">Change Password</h4>
                            <p class="text-sm theme-text-muted">Leave blank if you don't want to change your password</p>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label for="password" class="block text-sm font-medium theme-text-secondary mb-2">New Password</label>
                            <div class="relative">
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       class="w-full px-4 py-3 text-base rounded-lg shadow-sm transition-all duration-200
                                              theme-text-primary theme-border border
                                              theme-bg-primary/80 dark:bg-gray-900/80 dark:text-gray-100
                                              focus:ring-2 focus:ring-primary-dynamic/20 focus:border-primary-dynamic/60
                                              pl-12 placeholder-theme-text-muted dark:placeholder-gray-400"
                                       placeholder="Enter new password">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-key theme-text-muted dark:text-gray-400"></i>
                                </div>
                            </div>
                            <p class="mt-2 text-sm theme-text-muted">Password should be at least 8 characters long</p>
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium theme-text-secondary mb-2">Confirm New Password</label>
                            <div class="relative">
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       class="w-full px-4 py-3 text-base rounded-lg shadow-sm transition-all duration-200
                                              theme-text-primary theme-border border
                                              theme-bg-primary/80 dark:bg-gray-900/80 dark:text-gray-100
                                              focus:ring-2 focus:ring-primary-dynamic/20 focus:border-primary-dynamic/60
                                              pl-12 placeholder-theme-text-muted dark:placeholder-gray-400"
                                       placeholder="Confirm new password">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-shield-alt theme-text-muted dark:text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Area -->
            <div class="px-8 py-6 theme-bg-tertiary/60 backdrop-blur-sm theme-border border-t">
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-sm theme-text-muted">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span>Changes will be saved immediately</span>
                    </div>
                    <div class="flex space-x-4">
                        <button type="button" 
                                class="px-6 py-3 theme-bg-tertiary/80 hover:theme-bg-secondary/80 theme-text-secondary hover:theme-text-primary font-medium rounded-lg transition-all duration-200"
                                onclick="window.location.reload()">
                            <i class="fas fa-undo mr-2"></i>
                            Reset
                        </button>
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-primary-dynamic to-secondary-dynamic hover:from-secondary-dynamic hover:to-primary-dynamic text-white font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-save mr-2"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Security Notice -->
    <div class="px-8 py-4 bg-blue-50/60 dark:bg-blue-900/20 backdrop-blur-sm theme-border border-t border-blue-200/40 dark:border-blue-900/40">
        <div class="flex items-center">
            <i class="fas fa-shield-alt text-blue-500 dark:text-blue-300 mr-3"></i>
            <div>
                <p class="text-sm font-medium text-blue-900 dark:text-blue-200">Your information is secure</p>
                <p class="text-xs text-blue-700 dark:text-blue-400">We use industry-standard encryption to protect your data</p>
            </div>
        </div>
    </div>
</div>
@endsection
