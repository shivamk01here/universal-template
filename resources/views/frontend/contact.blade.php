@extends('layouts.app')

@section('content')
<div class="theme-gradient-primary min-h-screen flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg mx-auto w-full">

        <!-- Compact Heading -->
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold tracking-tight theme-text-primary mb-3">
                Contact Us
            </h2>
            <p class="text-sm theme-text-secondary leading-relaxed">
                Have a question? Send us a message and we'll get back to you.
            </p>
        </div>

        <!-- Premium Themed Card Form -->
        <div class="theme-bg-primary/90 shadow-lg rounded-2xl p-6 theme-border border relative overflow-hidden">
            <!-- Subtle background pattern -->
            <div class="absolute inset-0 theme-gradient-secondary rounded-2xl"></div>

            <div class="relative z-10">
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Name & Email Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium theme-text-secondary mb-1">Full Name</label>
                            <input type="text" name="name" required
                                class="w-full px-3 py-2.5 theme-border border rounded-lg focus:ring-2 focus:ring-primary-dynamic/20 focus:border-primary-dynamic/60 transition-all duration-200 theme-bg-primary/90 dark:bg-gray-900/80 theme-text-primary placeholder-theme-text-muted dark:placeholder-gray-400 text-sm"
                                placeholder="Your name">
                        </div>
                        <div>
                            <label class="block text-xs font-medium theme-text-secondary mb-1">Email</label>
                            <input type="email" name="email" required
                                class="w-full px-3 py-2.5 theme-border border rounded-lg focus:ring-2 focus:ring-primary-dynamic/20 focus:border-primary-dynamic/60 transition-all duration-200 theme-bg-primary/90 dark:bg-gray-900/80 theme-text-primary placeholder-theme-text-muted dark:placeholder-gray-400 text-sm"
                                placeholder="your@email.com">
                        </div>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label class="block text-xs font-medium theme-text-secondary mb-1">Subject</label>
                        <input type="text" name="subject" required
                            class="w-full px-3 py-2.5 theme-border border rounded-lg focus:ring-2 focus:ring-primary-dynamic/20 focus:border-primary-dynamic/60 transition-all duration-200 theme-bg-primary/90 dark:bg-gray-900/80 theme-text-primary placeholder-theme-text-muted dark:placeholder-gray-400 text-sm"
                            placeholder="What's this about?">
                    </div>

                    <!-- Message -->
                    <div>
                        <label class="block text-xs font-medium theme-text-secondary mb-1">Message</label>
                        <textarea name="message" rows="3" required
                            class="w-full px-3 py-2.5 theme-border border rounded-lg focus:ring-2 focus:ring-primary-dynamic/20 focus:border-primary-dynamic/60 transition-all duration-200 theme-bg-primary/90 dark:bg-gray-900/80 theme-text-primary placeholder-theme-text-muted dark:placeholder-gray-400 text-sm resize-none"
                            placeholder="How can we help you?"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" 
                            class="w-full flex items-center justify-center py-3 px-6 text-sm font-medium text-white bg-button-dynamic hover:opacity-90 rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary-dynamic/40 focus:ring-offset-1 transition-all duration-200">
                            <i class="fas fa-paper-plane mr-2 text-xs"></i>
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

<style>
.theme-gradient-primary {
    background: linear-gradient(to bottom right, var(--theme-tertiary, #f9fafb), var(--theme-primary, #ffffff), var(--theme-tertiary, #f8fafc));
}
[data-theme="dark"] .theme-gradient-primary {
    background: linear-gradient(to bottom right, var(--theme-secondary, #1f2937), var(--theme-tertiary, #111827));
}
.theme-gradient-secondary {
    background: linear-gradient(to bottom right, var(--theme-tertiary, #f3f4f6) 30%, var(--theme-primary, #ffffff) 100%);
    opacity: 0.2;
    pointer-events: none;
}
[data-theme="dark"] .theme-gradient-secondary {
    background: linear-gradient(to bottom right, var(--theme-secondary, #1f2937) 30%, var(--theme-primary, #111827) 100%);
    opacity: 0.15;
}
</style>
