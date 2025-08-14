@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg mx-auto w-full">
        
        <!-- Compact Heading -->
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold tracking-tight text-slate-800 mb-3">
                Contact Us
            </h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Have a question? Send us a message and we'll get back to you.
            </p>
        </div>

        <!-- Compact Premium Card Form -->
        <div class="bg-white shadow-lg rounded-2xl p-6 border border-slate-200 relative overflow-hidden">
            <!-- Subtle background pattern -->
            <div class="absolute inset-0 bg-gradient-to-br from-slate-50/30 to-slate-100/20 rounded-2xl"></div>
            
            <div class="relative z-10">
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Name & Email Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">Full Name</label>
                            <input type="text" name="name" required
                                class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:ring-1 focus:ring-slate-400 focus:border-slate-400 transition-all duration-200 bg-white placeholder-slate-400 text-sm"
                                placeholder="Your name">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-700 mb-1">Email</label>
                            <input type="email" name="email" required
                                class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:ring-1 focus:ring-slate-400 focus:border-slate-400 transition-all duration-200 bg-white placeholder-slate-400 text-sm"
                                placeholder="your@email.com">
                        </div>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Subject</label>
                        <input type="text" name="subject" required
                            class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:ring-1 focus:ring-slate-400 focus:border-slate-400 transition-all duration-200 bg-white placeholder-slate-400 text-sm"
                            placeholder="What's this about?">
                    </div>

                    <!-- Message -->
                    <div>
                        <label class="block text-xs font-medium text-slate-700 mb-1">Message</label>
                        <textarea name="message" rows="3" required
                            class="w-full px-3 py-2.5 border border-slate-300 rounded-lg focus:ring-1 focus:ring-slate-400 focus:border-slate-400 transition-all duration-200 bg-white placeholder-slate-400 text-sm resize-none"
                            placeholder="How can we help you?"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" 
                            class="w-full flex items-center justify-center py-3 px-6 text-sm font-medium text-white bg-slate-800 hover:bg-slate-900 rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-1 transition-all duration-200">
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