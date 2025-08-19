<footer class="bg-gradient-to-t from-theme-tertiary via-theme-secondary to-theme-primary border-t theme-border backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">

            {{-- Logo & About --}}
            <div class="md:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group footer-link">
                    <div class="flex-shrink-0">
                        <img src="{{ env('APP_URL') . '/' . ltrim($siteSettings['site_logo_url'] ?? '', '/') }}"
                             alt="{{ $siteSettings['site_name'] ?? '' }}"
                             class="h-12 w-auto transition-transform duration-200 group-hover:scale-105">
                    </div>
                    <span class="text-2xl font-light theme-text-primary group-hover:theme-text-secondary transition-colors duration-200 footer-link-text">
                        {{ $siteSettings['site_name'] ?? '' }}
                    </span>
                </a>
                <p class="mt-6 theme-text-secondary text-base leading-relaxed">
                    We provide top-quality services and products to make your life easier and better every day.
                </p>
                <div class="mt-8">
                    <h4 class="text-sm font-medium theme-text-primary mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <!-- Facebook -->
                        <a href="#" class="group footer-link">
                            <div class="w-10 h-10 theme-bg-primary/80 backdrop-blur-sm theme-border border rounded-full flex items-center justify-center shadow-sm hover:shadow-md hover:bg-blue-500/10 hover:border-blue-400/50 transition-all duration-200">
                                <i class="fab fa-facebook-f theme-text-muted group-hover:text-blue-600"></i>
                            </div>
                        </a>
                        <!-- Twitter -->
                        <a href="#" class="group footer-link">
                            <div class="w-10 h-10 theme-bg-primary/80 backdrop-blur-sm theme-border border rounded-full flex items-center justify-center shadow-sm hover:shadow-md hover:bg-blue-400/10 hover:border-blue-400/50 transition-all duration-200">
                                <i class="fab fa-twitter theme-text-muted group-hover:text-blue-400"></i>
                            </div>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="group footer-link">
                            <div class="w-10 h-10 theme-bg-primary/80 backdrop-blur-sm theme-border border rounded-full flex items-center justify-center shadow-sm hover:shadow-md hover:bg-pink-500/10 hover:border-pink-400/40 transition-all duration-200">
                                <i class="fab fa-instagram theme-text-muted group-hover:text-pink-500"></i>
                            </div>
                        </a>
                        <!-- LinkedIn -->
                        <a href="#" class="group footer-link">
                            <div class="w-10 h-10 theme-bg-primary/80 backdrop-blur-sm theme-border border rounded-full flex items-center justify-center shadow-sm hover:shadow-md hover:bg-blue-900/10 hover:border-blue-700/40 transition-all duration-200">
                                <i class="fab fa-linkedin-in theme-text-muted group-hover:text-blue-700"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Company --}}
            <div>
                <div class="flex items-center mb-6">
                    <i class="fas fa-building text-lg theme-text-muted mr-3"></i>
                    <h3 class="text-lg font-medium theme-text-primary">Company</h3>
                </div>
                <ul class="space-y-4">
                    @foreach($staticPages as $page)
                        <li>
                            <a href="{{ route('page.show', $page->slug) }}" class="footer-link text-base theme-text-secondary hover:theme-text-primary transition-colors duration-200 flex items-center group">
                                <i class="fas fa-chevron-right text-xs theme-text-muted mr-3 group-hover:theme-text-secondary group-hover:translate-x-1 transition-all duration-200"></i>
                                <span class="footer-link-text">{{ $page->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Quick Links --}}
            <div>
                <div class="flex items-center mb-6">
                    <i class="fas fa-link text-lg theme-text-muted mr-3"></i>
                    <h3 class="text-lg font-medium theme-text-primary">Quick Links</h3>
                </div>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('home') }}" class="footer-link text-base theme-text-secondary hover:theme-text-primary transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs theme-text-muted mr-3 group-hover:theme-text-secondary group-hover:translate-x-1 transition-all duration-200"></i>
                            <span class="footer-link-text">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('items.index') }}" class="footer-link text-base theme-text-secondary hover:theme-text-primary transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs theme-text-muted mr-3 group-hover:theme-text-secondary group-hover:translate-x-1 transition-all duration-200"></i>
                            <span class="footer-link-text">Services & Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blogs.index') }}" class="footer-link text-base theme-text-secondary hover:theme-text-primary transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs theme-text-muted mr-3 group-hover:theme-text-secondary group-hover:translate-x-1 transition-all duration-200"></i>
                            <span class="footer-link-text">Blog</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('faq.index') }}" class="footer-link text-base theme-text-secondary hover:theme-text-primary transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs theme-text-muted mr-3 group-hover:theme-text-secondary group-hover:translate-x-1 transition-all duration-200"></i>
                            <span class="footer-link-text">FAQ</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}" class="footer-link text-base theme-text-secondary hover:theme-text-primary transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs theme-text-muted mr-3 group-hover:theme-text-secondary group-hover:translate-x-1 transition-all duration-200"></i>
                            <span class="footer-link-text">Contact</span>
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div>
                <div class="flex items-center mb-6">
                    <i class="fas fa-address-book text-lg theme-text-muted mr-3"></i>
                    <h3 class="text-lg font-medium theme-text-primary">Contact Us</h3>
                </div>
                <ul class="space-y-5">
                    <li class="flex items-start group">
                        <div class="flex-shrink-0 w-10 h-10 theme-bg-tertiary rounded-lg flex items-center justify-center mr-4 group-hover:theme-bg-secondary transition-colors duration-200">
                            <i class="fas fa-map-marker-alt theme-text-muted"></i>
                        </div>
                        <div>
                            <p class="text-base theme-text-secondary leading-relaxed">123 Main Street, Your City</p>
                        </div>
                    </li>
                    <li class="flex items-start group">
                        <div class="flex-shrink-0 w-10 h-10 theme-bg-tertiary rounded-lg flex items-center justify-center mr-4 group-hover:theme-bg-secondary transition-colors duration-200">
                            <i class="fas fa-phone-alt theme-text-muted"></i>
                        </div>
                        <div>
                            <a href="tel:+1234567890" class="footer-link text-base theme-text-secondary hover:theme-text-primary transition-colors duration-200"><span class="footer-link-text">+1 (234) 567-890</span></a>
                        </div>
                    </li>
                    <li class="flex items-start group">
                        <div class="flex-shrink-0 w-10 h-10 theme-bg-tertiary rounded-lg flex items-center justify-center mr-4 group-hover:theme-bg-secondary transition-colors duration-200">
                            <i class="fas fa-envelope theme-text-muted"></i>
                        </div>
                        <div>
                            <a href="mailto:info@example.com" class="footer-link text-base theme-text-secondary hover:theme-text-primary transition-colors duration-200"><span class="footer-link-text">info@example.com</span></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="mt-16 pt-8 border-t theme-border">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="flex items-center text-base theme-text-muted">
                    <i class="fas fa-copyright mr-2"></i>
                    <span>{{ date('Y') }} {{ $siteSettings['site_name'] ?? '' }}. All rights reserved.</span>
                </div>
                <div class="flex items-center space-x-8 mt-6 lg:mt-0">
                    <a href="/p/privacy-policy" class="footer-link text-base theme-text-muted hover:theme-text-primary transition-colors duration-200 flex items-center">
                        <i class="fas fa-shield-alt mr-2"></i>
                        <span class="footer-link-text">Privacy Policy</span>
                    </a>
                    <a href="/p/terms-and-conditions" class="footer-link text-base theme-text-muted hover:theme-text-primary transition-colors duration-200 flex items-center">
                        <i class="fas fa-file-contract mr-2"></i>
                        <span class="footer-link-text">Terms of Service</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <style>
    /* Footer link underline hover (just for text, not icon/flex) */
    @media (min-width: 1024px) {
        .footer-link-text {
            position: relative;
            display: inline-block;
            transition: color .2s;
        }
        .footer-link-text::after {
            content: '';
            position: absolute;
            left: 0; bottom: -4px; height: 2px; width: 0;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transition: width .2s;
        }
        .footer-link:hover .footer-link-text::after,
        .footer-link:focus-visible .footer-link-text::after {
            width: 100%;
        }
    }
    </style>
</footer>
