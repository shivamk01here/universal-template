<footer class="bg-gradient-to-t from-gray-100 via-gray-50 to-white border-t border-gray-200/60 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">

            {{-- Logo & About --}}
            <div class="md:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="flex-shrink-0">
                        <img src="{{ $siteSettings['site_logo_url'] ?? '' }}" 
                             alt="{{ $siteSettings['site_name'] ?? '' }}" 
                             class="h-12 w-auto transition-transform duration-200 group-hover:scale-105">
                    </div>
                    <span class="text-2xl font-light text-gray-900 group-hover:text-gray-700 transition-colors duration-200">
                        {{ $siteSettings['site_name'] ?? '' }}
                    </span>
                </a>
                
                <p class="mt-6 text-gray-600 text-base leading-relaxed">
                    We provide top-quality services and products to make your life easier and better every day.
                </p>
                
                <div class="mt-8">
                    <h4 class="text-sm font-medium text-gray-900 mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="group">
                            <div class="w-10 h-10 bg-white/80 backdrop-blur-sm border border-gray-200/60 rounded-full flex items-center justify-center shadow-sm hover:shadow-md hover:bg-blue-50/80 hover:border-blue-200/60 transition-all duration-200">
                                <i class="fab fa-facebook-f text-gray-500 group-hover:text-blue-600"></i>
                            </div>
                        </a>
                        <a href="#" class="group">
                            <div class="w-10 h-10 bg-white/80 backdrop-blur-sm border border-gray-200/60 rounded-full flex items-center justify-center shadow-sm hover:shadow-md hover:bg-blue-50/80 hover:border-blue-200/60 transition-all duration-200">
                                <i class="fab fa-twitter text-gray-500 group-hover:text-blue-400"></i>
                            </div>
                        </a>
                        <a href="#" class="group">
                            <div class="w-10 h-10 bg-white/80 backdrop-blur-sm border border-gray-200/60 rounded-full flex items-center justify-center shadow-sm hover:shadow-md hover:bg-pink-50/80 hover:border-pink-200/60 transition-all duration-200">
                                <i class="fab fa-instagram text-gray-500 group-hover:text-pink-500"></i>
                            </div>
                        </a>
                        <a href="#" class="group">
                            <div class="w-10 h-10 bg-white/80 backdrop-blur-sm border border-gray-200/60 rounded-full flex items-center justify-center shadow-sm hover:shadow-md hover:bg-blue-50/80 hover:border-blue-200/60 transition-all duration-200">
                                <i class="fab fa-linkedin-in text-gray-500 group-hover:text-blue-700"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Company --}}
            <div>
                <div class="flex items-center mb-6">
                    <i class="fas fa-building text-lg text-gray-500 mr-3"></i>
                    <h3 class="text-lg font-medium text-gray-900">Company</h3>
                </div>
                <ul class="space-y-4">
                    @foreach($staticPages as $page)
                        <li>
                            <a href="{{ route('page.show', $page->slug) }}" 
                               class="text-base text-gray-600 hover:text-gray-900 transition-colors duration-200 flex items-center group">
                                <i class="fas fa-chevron-right text-xs text-gray-300 mr-3 group-hover:text-gray-500 group-hover:translate-x-1 transition-all duration-200"></i>
                                {{ $page->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Quick Links --}}
            <div>
                <div class="flex items-center mb-6">
                    <i class="fas fa-link text-lg text-gray-500 mr-3"></i>
                    <h3 class="text-lg font-medium text-gray-900">Quick Links</h3>
                </div>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('home') }}" 
                           class="text-base text-gray-600 hover:text-gray-900 transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs text-gray-300 mr-3 group-hover:text-gray-500 group-hover:translate-x-1 transition-all duration-200"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('items.index') }}" 
                           class="text-base text-gray-600 hover:text-gray-900 transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs text-gray-300 mr-3 group-hover:text-gray-500 group-hover:translate-x-1 transition-all duration-200"></i>
                            Services & Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blogs.index') }}" 
                           class="text-base text-gray-600 hover:text-gray-900 transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs text-gray-300 mr-3 group-hover:text-gray-500 group-hover:translate-x-1 transition-all duration-200"></i>
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('faq.index') }}" 
                           class="text-base text-gray-600 hover:text-gray-900 transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs text-gray-300 mr-3 group-hover:text-gray-500 group-hover:translate-x-1 transition-all duration-200"></i>
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}" 
                           class="text-base text-gray-600 hover:text-gray-900 transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs text-gray-300 mr-3 group-hover:text-gray-500 group-hover:translate-x-1 transition-all duration-200"></i>
                            Contact
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div>
                <div class="flex items-center mb-6">
                    <i class="fas fa-address-book text-lg text-gray-500 mr-3"></i>
                    <h3 class="text-lg font-medium text-gray-900">Contact Us</h3>
                </div>
                <ul class="space-y-5">
                    <li class="flex items-start group">
                        <div class="flex-shrink-0 w-10 h-10 bg-gray-100/80 rounded-lg flex items-center justify-center mr-4 group-hover:bg-gray-200/80 transition-colors duration-200">
                            <i class="fas fa-map-marker-alt text-gray-500"></i>
                        </div>
                        <div>
                            <p class="text-base text-gray-600 leading-relaxed">123 Main Street, Your City</p>
                        </div>
                    </li>
                    <li class="flex items-start group">
                        <div class="flex-shrink-0 w-10 h-10 bg-gray-100/80 rounded-lg flex items-center justify-center mr-4 group-hover:bg-gray-200/80 transition-colors duration-200">
                            <i class="fas fa-phone-alt text-gray-500"></i>
                        </div>
                        <div>
                            <a href="tel:+1234567890" class="text-base text-gray-600 hover:text-gray-900 transition-colors duration-200">+1 (234) 567-890</a>
                        </div>
                    </li>
                    <li class="flex items-start group">
                        <div class="flex-shrink-0 w-10 h-10 bg-gray-100/80 rounded-lg flex items-center justify-center mr-4 group-hover:bg-gray-200/80 transition-colors duration-200">
                            <i class="fas fa-envelope text-gray-500"></i>
                        </div>
                        <div>
                            <a href="mailto:info@example.com" class="text-base text-gray-600 hover:text-gray-900 transition-colors duration-200">info@example.com</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="mt-16 pt-8 border-t border-gray-200/60">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="flex items-center text-base text-gray-500">
                    <i class="fas fa-copyright mr-2"></i>
                    <span>{{ date('Y') }} {{ $siteSettings['site_name'] ?? '' }}. All rights reserved.</span>
                </div>
                <div class="flex items-center space-x-8 mt-6 lg:mt-0">
                    <a href="/p/privacy-policy" class="text-base text-gray-500 hover:text-gray-900 transition-colors duration-200 flex items-center">
                        <i class="fas fa-shield-alt mr-2"></i>
                        Privacy Policy
                    </a>
                    <a href="/p/terms-and-conditions" class="text-base text-gray-500 hover:text-gray-900 transition-colors duration-200 flex items-center">
                        <i class="fas fa-file-contract mr-2"></i>
                        Terms of Service
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
