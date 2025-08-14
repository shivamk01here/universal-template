CREATE DATABASE IF NOT EXISTS `laravel_universal` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `laravel_universal`;

CREATE TABLE `users` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `email` varchar(255) NOT NULL UNIQUE,
 `email_verified_at` timestamp NULL DEFAULT NULL,
 `password` varchar(255) NOT NULL,
 `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
 `remember_token` varchar(100) DEFAULT NULL,
 `created_at` timestamp NULL DEFAULT current_timestamp(),
 `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`name`, `email`, `password`, `role`, `email_verified_at`) VALUES
('Admin User', 'admin@urbanservices.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '2025-01-01 10:00:00'),
('Priya Sharma', 'priya.sharma@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '2025-01-02 11:30:00'),
('Rohan Mehta', 'rohan.mehta@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '2025-01-03 14:15:00'),
('Anjali Singh', 'anjali.singh@hotmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '2025-01-04 09:45:00'),
('Vikram Gupta', 'vikram.gupta@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '2025-01-05 16:20:00'),
('Sneha Patel', 'sneha.patel@outlook.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '2025-01-06 12:10:00'),
('Arjun Kumar', 'arjun.kumar@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '2025-01-07 08:30:00'),
('Deepika Rao', 'deepika.rao@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '2025-01-08 13:45:00'),
('Rahul Jain', 'rahul.jain@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '2025-01-09 15:25:00'),
('Kavya Nair', 'kavya.nair@hotmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '2025-01-10 11:15:00'),
('Siddharth Shah', 'siddharth.shah@outlook.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '2025-01-11 17:40:00'),
('Meera Agarwal', 'meera.agarwal@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '2025-01-12 10:55:00'),
('Karan Malhotra', 'karan.malhotra@yahoo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'customer', '2025-01-13 14:30:00');

CREATE TABLE `categories` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `slug` varchar(255) NOT NULL UNIQUE,
 `description` text DEFAULT NULL,
 `image_url` varchar(255) DEFAULT NULL,
 `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
 `created_at` timestamp NULL DEFAULT current_timestamp(),
 `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`),
 FOREIGN KEY (`parent_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image_url`) VALUES
(1, 'Home Services', 'home-services', 'All services related to maintaining and improving your home.', 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop'),
(2, 'Beauty & Wellness', 'beauty-wellness', 'Pamper yourself with our beauty and wellness services.', 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&h=300&fit=crop'),
(3, 'Appliance Repair', 'appliance-repair', 'Expert repair for all your home appliances.', 'https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?w=400&h=300&fit=crop'),
(4, 'Shop Products', 'shop-products', 'Essential products for your home and lifestyle.', 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=400&h=300&fit=crop'),
(5, 'Automotive Services', 'automotive-services', 'Complete car care and maintenance services.', 'https://images.unsplash.com/photo-1615906655593-ad0386982a0f?w=400&h=300&fit=crop'),
(6, 'Electronics Repair', 'electronics-repair', 'Repair services for phones, laptops, and gadgets.', 'https://images.unsplash.com/photo-1518717758536-85ae29035b6d?w=400&h=300&fit=crop'),
(7, 'Pest Control', 'pest-control', 'Professional pest control and fumigation services.', 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=300&fit=crop'),
(8, 'Interior Design', 'interior-design', 'Transform your space with professional interior design.', 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400&h=300&fit=crop'),
(9, 'Fitness & Health', 'fitness-health', 'Personal training and health consultation services.', 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=300&fit=crop'),
(10, 'Event Planning', 'event-planning', 'Professional event planning and management services.', 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=400&h=300&fit=crop'),
(11, 'Education & Tutoring', 'education-tutoring', 'Home tutoring and skill development classes.', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&h=300&fit=crop'),
(12, 'Pet Care', 'pet-care', 'Grooming and care services for your beloved pets.', 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=400&h=300&fit=crop');

CREATE TABLE `items` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `slug` varchar(255) NOT NULL UNIQUE,
 `description` longtext DEFAULT NULL,
 `short_description` text DEFAULT NULL,
 `base_price` decimal(10,2) NOT NULL,
 `category_id` bigint(20) UNSIGNED NOT NULL,
 `item_type` enum('PRODUCT','SERVICE') NOT NULL,
 `is_featured` tinyint(1) NOT NULL DEFAULT 0,
 `is_active` tinyint(1) NOT NULL DEFAULT 1,
 `created_at` timestamp NULL DEFAULT current_timestamp(),
 `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`),
 FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `items` (`name`, `slug`, `description`, `short_description`, `base_price`, `category_id`, `item_type`, `is_featured`) VALUES
('Deep Home Cleaning', 'deep-home-cleaning', 'A thorough, top-to-bottom cleaning of your entire home. Our professionals use eco-friendly chemicals and professional equipment to make your home sparkle. Includes kitchen, bathrooms, bedrooms, and living areas.', 'Intensive cleaning for a spotless home.', 4999.00, 1, 'SERVICE', 1),
('Classic Manicure & Pedicure', 'classic-mani-pedi', 'A relaxing session that includes nail shaping, cuticle care, a gentle massage, and application of your favorite nail polish. Perfect for maintaining healthy and beautiful nails.', 'Essential nail care for hands and feet.', 1299.00, 2, 'SERVICE', 1),
('AC Service & Repair', 'ac-service-repair', 'Comprehensive check-up, cleaning, and repair for your air conditioning unit. Ensures efficient cooling and longevity of your appliance. Recommended every 6 months.', 'Keep your AC running smoothly.', 799.00, 3, 'SERVICE', 1),
('Organic Cleaning Kit', 'organic-cleaning-kit', 'A set of all-natural, non-toxic cleaning agents for your home. Includes a multi-surface cleaner, glass cleaner, and a bathroom disinfectant. Safe for kids and pets.', 'Eco-friendly cleaning solutions.', 999.00, 4, 'PRODUCT', 1),
('Car Wash & Detailing', 'car-wash-detailing', 'Complete exterior and interior car cleaning service. Includes washing, waxing, vacuuming, and dashboard cleaning. Your car will look brand new.', 'Premium car cleaning service.', 2499.00, 5, 'SERVICE', 1),
('Mobile Screen Repair', 'mobile-screen-repair', 'Professional screen replacement for all smartphone brands. Original parts used with 6-month warranty. Same-day service available.', 'Quick and reliable phone repair.', 1899.00, 6, 'SERVICE', 0),
('Cockroach Control Treatment', 'cockroach-control', 'Effective cockroach elimination treatment using safe, odorless gel baits. Long-lasting protection for up to 6 months. Family and pet-safe.', 'Safe and effective pest control.', 1299.00, 7, 'SERVICE', 0),
('Living Room Makeover', 'living-room-makeover', 'Complete living room interior design and decoration service. Includes furniture arrangement, color consultation, and decor suggestions.', 'Transform your living space.', 15999.00, 8, 'SERVICE', 1),
('Personal Fitness Training', 'personal-fitness-training', 'One-on-one fitness training sessions at your home. Customized workout plans, diet guidance, and regular progress tracking included.', 'Achieve your fitness goals at home.', 2999.00, 9, 'SERVICE', 0),
('Birthday Party Planning', 'birthday-party-planning', 'Complete birthday party organization including theme decoration, catering coordination, entertainment, and photography. Memorable celebrations guaranteed.', 'Stress-free party planning.', 12999.00, 10, 'SERVICE', 1),
('Mathematics Home Tuition', 'math-home-tuition', 'Expert mathematics tutoring for students from class 6 to 12. Experienced teachers, customized teaching methods, and regular progress assessments.', 'Excel in mathematics with expert guidance.', 1999.00, 11, 'SERVICE', 0),
('Dog Grooming Service', 'dog-grooming', 'Professional dog grooming including bath, haircut, nail trimming, and ear cleaning. Mobile service available at your doorstep.', 'Keep your pet looking and feeling great.', 1599.00, 12, 'SERVICE', 0),
('Aromatherapy Massage Oil', 'aromatherapy-massage-oil', 'A blend of essential oils designed for relaxation and stress relief. Lavender and chamomile scents help calm the mind and body.', 'Relaxing and calming massage oil.', 599.00, 2, 'PRODUCT', 0);

CREATE TABLE `item_images` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `item_id` bigint(20) UNSIGNED NOT NULL,
 `image_url` varchar(255) NOT NULL,
 `alt_text` varchar(255) DEFAULT NULL,
 `is_primary` tinyint(1) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`),
 FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `item_images` (`item_id`, `image_url`, `alt_text`, `is_primary`) VALUES
(1, 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=800&h=600&fit=crop', 'Deep Home Cleaning Service', 1),
(1, 'https://images.unsplash.com/photo-1563453392212-326f5e854473?w=800&h=600&fit=crop', 'Sparkling clean kitchen', 0),
(2, 'https://images.unsplash.com/photo-1604654894610-df63bc536371?w=800&h=600&fit=crop', 'Manicure and Pedicure', 1),
(2, 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800&h=600&fit=crop', 'Beautiful nail art', 0),
(3, 'https://images.unsplash.com/photo-1631545022628-5ad5df94e7c8?w=800&h=600&fit=crop', 'AC unit servicing', 1),
(3, 'https://images.unsplash.com/photo-1607472586893-edb57bdc0e39?w=800&h=600&fit=crop', 'AC maintenance tools', 0),
(4, 'https://images.unsplash.com/photo-1563453392212-326f5e854473?w=800&h=600&fit=crop', 'Organic Cleaning Product Kit', 1),
(4, 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=800&h=600&fit=crop', 'Natural cleaning supplies', 0),
(5, 'https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?w=800&h=600&fit=crop', 'Car washing service', 1),
(5, 'https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?w=800&h=600&fit=crop', 'Clean car interior', 0),
(6, 'https://images.unsplash.com/photo-1512499617640-c74ae3a79d37?w=800&h=600&fit=crop', 'Mobile phone repair', 1),
(6, 'https://images.unsplash.com/photo-1609952124444-026bad4eaf51?w=800&h=600&fit=crop', 'Phone screen replacement', 0),
(7, 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop', 'Pest control treatment', 1),
(8, 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800&h=600&fit=crop', 'Modern living room design', 1),
(8, 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&h=600&fit=crop', 'Interior decoration', 0),
(9, 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=600&fit=crop', 'Personal fitness training', 1),
(10, 'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=800&h=600&fit=crop', 'Birthday party decoration', 1),
(11, 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=600&fit=crop', 'Mathematics tutoring', 1),
(12, 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=800&h=600&fit=crop', 'Dog grooming service', 1),
(13, 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800&h=600&fit=crop', 'Aromatherapy Oil Bottle', 1);

CREATE TABLE `attributes` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `type` varchar(50) NOT NULL DEFAULT 'text',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `attributes` (`name`, `type`) VALUES
('House Size', 'select'),
('Duration', 'text'),
('Includes', 'textarea'),
('Volume', 'text'),
('Scent', 'text'),
('Location Specific', 'boolean'),
('Age Group', 'select'),
('Skill Level', 'select'),
('Material Type', 'text'),
('Warranty Period', 'text'),
('Service Area', 'text'),
('Session Count', 'number');

CREATE TABLE `item_attributes` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `item_id` bigint(20) UNSIGNED NOT NULL,
 `attribute_id` bigint(20) UNSIGNED NOT NULL,
 `value` text NOT NULL,
 PRIMARY KEY (`id`),
 FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE,
 FOREIGN KEY (`attribute_id`) REFERENCES `attributes`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `item_attributes` (`item_id`, `attribute_id`, `value`) VALUES
(1, 1, 'Up to 3 BHK'),
(1, 2, 'Approx. 4-5 hours'),
(1, 6, 'Yes'),
(2, 2, '90 minutes'),
(2, 3, 'Nail shaping, cuticle care, massage, polish application'),
(3, 6, 'Yes'),
(3, 10, '6 months on parts'),
(4, 3, '1 Multi-Surface Cleaner (500ml), 1 Glass Cleaner (500ml), 1 Bathroom Cleaner (500ml)'),
(4, 4, '3 x 500ml'),
(5, 2, '2-3 hours'),
(5, 11, 'Within 10km radius'),
(6, 10, '6 months'),
(6, 9, 'Original OEM parts'),
(7, 2, '30-45 minutes treatment'),
(7, 10, '6 months effectiveness'),
(8, 2, '3-5 days'),
(8, 3, 'Design consultation, furniture arrangement, color scheme, decor items'),
(9, 12, '8 sessions per month'),
(9, 7, 'All ages'),
(10, 2, 'Full day event'),
(10, 3, 'Theme decoration, catering coordination, entertainment, photography'),
(11, 7, 'Class 6 to 12'),
(11, 12, '8 sessions per month'),
(12, 2, '2-3 hours'),
(12, 3, 'Bath, haircut, nail trimming, ear cleaning'),
(13, 4, '100ml'),
(13, 5, 'Lavender & Chamomile');

CREATE TABLE `site_settings` (
 `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
 `key` varchar(255) NOT NULL UNIQUE,
 `value` text DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `site_settings` (`key`, `value`) VALUES
('site_name', 'Urban Services'),
('site_logo_url', 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=150&h=50&fit=crop'),
('contact_email', 'support@urbanservices.com'),
('contact_phone', '+91 98765 43210'),
('footer_about_us', 'Urban Services is your one-stop solution for all home and personal care needs. We connect you with trusted professionals to make your life easier.'),
('footer_copyright', '© 2025 Urban Services. All Rights Reserved.'),
('company_address', '123 Service Street, Gurugram, Haryana 122001'),
('support_hours', 'Monday to Sunday: 8:00 AM - 10:00 PM'),
('social_facebook', 'https://facebook.com/urbanservices'),
('social_instagram', 'https://instagram.com/urbanservices'),
('social_twitter', 'https://twitter.com/urbanservices'),
('whatsapp_number', '+91 98765 43210');

CREATE TABLE `page_sections` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `page_slug` varchar(255) NOT NULL,
 `section_slug` varchar(255) NOT NULL,
 `title` varchar(255) DEFAULT NULL,
 `subtitle` text DEFAULT NULL,
 `content` longtext DEFAULT NULL,
 `image_url` varchar(255) DEFAULT NULL,
 `is_active` tinyint(1) NOT NULL DEFAULT 1,
 `sort_order` int(11) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `page_sections` (`page_slug`, `section_slug`, `title`, `subtitle`, `content`, `image_url`, `is_active`, `sort_order`) VALUES
('homepage', 'hero', 'Life is Easy & Comfortable', 'The best services at your doorstep. Book professionals for anything you need, anytime you want.', '{"button_text": "Explore Services", "button_link": "/items"}', 'https://images.unsplash.com/photo-1556740738-b6a63e27c4df?w=1200&h=800&fit=crop', 1, 0),
('homepage', 'featured-services', 'Featured Services', 'Our most popular services trusted by thousands of customers.', '{"services_count": 6}', NULL, 1, 1),
('homepage', 'how-it-works', 'How It Works', 'Get your job done in just a few simple steps.', '{"steps": [{"icon": "fa-search", "title": "Choose a Service", "description": "Browse our wide range of services and products."}, {"icon": "fa-calendar-check", "title": "Book a Slot", "description": "Select a convenient date and time for your service."}, {"icon": "fa-credit-card", "title": "Pay Securely", "description": "Pay with cash on delivery after the service is completed."}]}', NULL, 1, 2),
('homepage', 'testimonials', 'What Our Customers Say', 'We are trusted by thousands of happy customers.', '{"testimonials": [{"quote": "The cleaning service was phenomenal! My house has never looked this good. Highly recommended.", "author": "Priya S.", "location": "Delhi"}, {"quote": "Quick and professional AC repair. The technician was very knowledgeable and fixed the issue in no time.", "author": "Rohan M.", "location": "Mumbai"}, {"quote": "Excellent car detailing service. My car looks brand new after their treatment.", "author": "Vikram G.", "location": "Bangalore"}]}', NULL, 1, 3),
('homepage', 'stats', 'Why Choose Urban Services', 'Numbers that speak for our quality and reliability.', '{"stats": [{"number": "50000+", "label": "Happy Customers"}, {"number": "500+", "label": "Expert Professionals"}, {"number": "100+", "label": "Services Available"}, {"number": "4.8/5", "label": "Average Rating"}]}', NULL, 1, 4),
('about', 'mission', 'Our Mission', 'Transforming the way people access home and personal services.', '{"description": "We believe everyone deserves access to quality services at affordable prices. Our mission is to connect customers with skilled professionals, making life easier and more convenient."}', 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=800&h=600&fit=crop', 1, 0),
('about', 'team', 'Meet Our Team', 'Dedicated professionals working to serve you better.', '{"team_members": [{"name": "Rajesh Kumar", "position": "CEO & Founder", "image": "https://images.unsplash.com/photo-1560250097-0b93528c311a?w=300&h=300&fit=crop"}, {"name": "Sunita Sharma", "position": "Operations Head", "image": "https://images.unsplash.com/photo-1580489944761-15a19d654956?w=300&h=300&fit=crop"}]}', NULL, 1, 1),
('contact', 'contact-info', 'Get in Touch', 'We are here to help you with any questions or concerns.', '{"office_hours": "Monday to Sunday: 8:00 AM - 10:00 PM", "response_time": "We typically respond within 2 hours"}', NULL, 1, 0),
('services', 'service-benefits', 'Why Our Services', 'Quality assurance and customer satisfaction guaranteed.', '{"benefits": [{"title": "Verified Professionals", "description": "All service providers are background checked and verified"}, {"title": "Quality Guarantee", "description": "We ensure high-quality service delivery every time"}, {"title": "Affordable Pricing", "description": "Competitive rates with transparent pricing"}]}', NULL, 1, 0),
('faq', 'common-questions', 'Frequently Asked Questions', 'Find answers to the most commonly asked questions.', '{"faqs": [{"question": "How do I book a service?", "answer": "Simply browse our services, select your preferred slot, and confirm your booking."}, {"question": "What payment methods do you accept?", "answer": "We accept cash on delivery, UPI, credit/debit cards, and digital wallets."}]}', NULL, 1, 0),
('privacy', 'data-protection', 'Privacy Policy', 'How we protect and use your personal information.', '{"last_updated": "January 2025", "sections": ["Data Collection", "Data Usage", "Data Protection", "User Rights"]}', NULL, 1, 0),
('terms', 'service-terms', 'Terms of Service', 'Terms and conditions for using our platform.', '{"last_updated": "January 2025", "sections": ["Service Usage", "User Responsibilities", "Payment Terms", "Cancellation Policy"]}', NULL, 1, 0);

CREATE TABLE `sliders` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `title` varchar(255) NOT NULL,
 `subtitle` text DEFAULT NULL,
 `image_url` varchar(255) NOT NULL,
 `cta_text` varchar(255) DEFAULT NULL,
 `cta_link` varchar(255) DEFAULT NULL,
 `is_active` tinyint(1) NOT NULL DEFAULT 1,
 `sort_order` int(11) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sliders` (`title`, `subtitle`, `image_url`, `cta_text`, `cta_link`, `is_active`, `sort_order`) VALUES
('Flat 20% Off On First Booking', 'Use code FIRST20 to avail the offer on any service.', 'https://images.unsplash.com/photo-1558002038-1055907df827?w=1200&h=600&fit=crop', 'Book Now', '/items', 1, 0),
('Monsoon Appliance Care', 'Protect your electronics this rainy season with expert check-ups.', 'https://images.unsplash.com/photo-1615752363829-8141355ce548?w=1200&h=600&fit=crop', 'See Details', '/categories/appliance-repair', 1, 1),
('New Year Home Makeover', 'Transform your home with our interior design services. Special packages available.', 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1200&h=600&fit=crop', 'Explore Now', '/categories/interior-design', 1, 2),
INSERT INTO `sliders` (`title`, `subtitle`, `image_url`, `cta_text`, `cta_link`, `is_active`, `sort_order`) VALUES
('Flat 20% Off On First Booking', 'Use code FIRST20 to avail the offer on any service.', 'https://images.unsplash.com/photo-1558002038-1055907df827?w=1200&h=600&fit=crop', 'Book Now', '/items', 1, 0),
('Monsoon Appliance Care', 'Protect your electronics this rainy season with expert check-ups.', 'https://images.unsplash.com/photo-1615752363829-8141355ce548?w=1200&h=600&fit=crop', 'See Details', '/categories/appliance-repair', 1, 1),
('New Year Home Makeover', 'Transform your home with our interior design services. Special packages available.', 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1200&h=600&fit=crop', 'Explore Now', '/categories/interior-design', 1, 2),
('Car Care Special', 'Professional car detailing at your doorstep. Book now for sparkling clean results.', 'https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?w=1200&h=600&fit=crop', 'Book Service', '/categories/automotive-services', 1, 2),
('Beauty at Home', 'Enjoy salon-quality beauty services in the comfort of your home.', 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=1200&h=600&fit=crop', 'Book Now', '/categories/beauty-wellness', 1, 3),
('Pest-Free Home Guarantee', 'Complete pest control solutions with 6-month effectiveness guarantee.', 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&h=600&fit=crop', 'Get Quote', '/categories/pest-control', 1, 4),
('Electronics Repair Hub', 'Fix your phones, laptops, and gadgets with original parts and warranty.', 'https://images.unsplash.com/photo-1518717758536-85ae29035b6d?w=1200&h=600&fit=crop', 'Repair Now', '/categories/electronics-repair', 1, 5),
('Fitness Goals Made Easy', 'Personal trainers at your home. Achieve your fitness goals with expert guidance.', 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1200&h=600&fit=crop', 'Start Training', '/categories/fitness-health', 1, 6),
('Perfect Party Planning', 'Memorable events planned to perfection. Birthday parties, anniversaries, and more.', 'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?w=1200&h=600&fit=crop', 'Plan Event', '/categories/event-planning', 1, 7),
('Home Tutoring Services', 'Expert tutors for all subjects and competitive exam preparation.', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=1200&h=600&fit=crop', 'Find Tutor', '/categories/education-tutoring', 1, 8),
('Pet Care Excellence', 'Professional grooming and care services for your beloved pets.', 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=1200&h=600&fit=crop', 'Book Grooming', '/categories/pet-care', 1, 9),
('Weekend Special Offers', 'Exclusive weekend discounts on all home services. Limited time offer.', 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=1200&h=600&fit=crop', 'View Offers', '/items', 1, 10);

CREATE TABLE `reviews` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `item_id` bigint(20) UNSIGNED NOT NULL,
 `user_id` bigint(20) UNSIGNED NOT NULL,
 `rating` tinyint(3) UNSIGNED NOT NULL,
 `comment` text DEFAULT NULL,
 `created_at` timestamp NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`),
 FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE,
 FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `reviews` (`item_id`, `user_id`, `rating`, `comment`) VALUES
(1, 2, 5, 'Absolutely fantastic service. The team was professional and my home is sparkling clean. Will definitely book again!'),
(3, 3, 4, 'Good and timely service. The technician was polite and explained the issue well. My AC is working perfectly now.'),
(1, 4, 5, 'Amazing deep cleaning service. They cleaned areas I never thought could be cleaned. Highly satisfied!'),
(2, 5, 4, 'Great manicure and pedicure service at home. The beautician was skilled and used quality products.'),
(5, 6, 5, 'Excellent car detailing service. My car looks brand new. Professional team and reasonable pricing.'),
(6, 7, 4, 'Quick mobile screen repair with original parts. Good warranty period and professional service.'),
(8, 8, 5, 'Outstanding interior design consultation. They transformed my living room completely. Love the new look!'),
(9, 9, 4, 'Personal trainer is very knowledgeable and motivating. Seeing good results after 2 months of training.'),
(10, 10, 5, 'Perfect birthday party arrangement. Kids loved the decoration and entertainment. Stress-free experience!'),
(11, 11, 4, 'Mathematics tutor is excellent. My child improved grades significantly. Highly recommend this service.'),
(12, 12, 5, 'Dog grooming service was fantastic. My pet looks adorable and the groomer was very gentle and caring.'),
(7, 13, 4, 'Effective pest control treatment. No cockroaches for 4 months now. Good value for money service.');

CREATE TABLE `user_addresses` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `user_id` bigint(20) UNSIGNED NOT NULL,
 `address_line_1` varchar(255) NOT NULL,
 `address_line_2` varchar(255) DEFAULT NULL,
 `city` varchar(255) NOT NULL,
 `state` varchar(255) NOT NULL,
 `pincode` varchar(10) NOT NULL,
 `is_default` tinyint(1) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`),
 FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_addresses` (`user_id`, `address_line_1`, `address_line_2`, `city`, `state`, `pincode`, `is_default`) VALUES
(2, 'A-101 Green Valley Apartments', 'Sector 45', 'Gurugram', 'Haryana', '122003', 1),
(3, 'B-205 Sunrise Heights', 'Near City Mall', 'Delhi', 'Delhi', '110015', 1),
(4, 'C-302 Blue Ridge Society', 'Golf Course Road', 'Gurugram', 'Haryana', '122002', 1),
(5, 'D-504 Park View Residency', 'Sector 62', 'Noida', 'Uttar Pradesh', '201301', 1),
(6, 'E-105 Royal Gardens', 'Malviya Nagar', 'Delhi', 'Delhi', '110017', 1),
(7, '201 Silver Oak Towers', 'MG Road', 'Bangalore', 'Karnataka', '560001', 1),
(8, '15 Lajpat Nagar Main Road', 'Near Metro Station', 'Delhi', 'Delhi', '110024', 1),
(9, 'F-603 Diamond Heights', 'Sector 51', 'Gurugram', 'Haryana', '122018', 1),
(10, '45 Koramangala 4th Block', 'Near Forum Mall', 'Bangalore', 'Karnataka', '560034', 1),
(11, 'G-201 Emerald City', 'Sector 65', 'Gurugram', 'Haryana', '122005', 1),
(12, '22 Bandra West', 'Near Linking Road', 'Mumbai', 'Maharashtra', '400050', 1),
(13, 'H-405 Crystal Plaza', 'Cyber City', 'Gurugram', 'Haryana', '122002', 1);

CREATE TABLE `orders` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `user_id` bigint(20) UNSIGNED DEFAULT NULL,
 `guest_id` varchar(255) DEFAULT NULL,
 `customer_name` varchar(255) NOT NULL,
 `customer_email` varchar(255) NOT NULL,
 `customer_phone` varchar(255) NOT NULL,
 `address_details` text NOT NULL,
 `sub_total` decimal(10,2) NOT NULL,
 `total_amount` decimal(10,2) NOT NULL,
 `payment_method` varchar(50) NOT NULL DEFAULT 'cod',
 `status` enum('pending','confirmed','processing','completed','cancelled') NOT NULL DEFAULT 'pending',
 `created_at` timestamp NULL DEFAULT current_timestamp(),
 `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`),
 FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `orders` (`user_id`, `customer_name`, `customer_email`, `customer_phone`, `address_details`, `sub_total`, `total_amount`, `payment_method`, `status`) VALUES
(2, 'Priya Sharma', 'priya.sharma@gmail.com', '+91 98765 43211', '{"address_line_1": "A-101 Green Valley Apartments", "address_line_2": "Sector 45", "city": "Gurugram", "state": "Haryana", "pincode": "122003"}', 4999.00, 4999.00, 'cod', 'completed'),
(3, 'Rohan Mehta', 'rohan.mehta@yahoo.com', '+91 98765 43212', '{"address_line_1": "B-205 Sunrise Heights", "address_line_2": "Near City Mall", "city": "Delhi", "state": "Delhi", "pincode": "110015"}', 799.00, 799.00, 'upi', 'completed'),
(4, 'Anjali Singh', 'anjali.singh@hotmail.com', '+91 98765 43213', '{"address_line_1": "C-302 Blue Ridge Society", "address_line_2": "Golf Course Road", "city": "Gurugram", "state": "Haryana", "pincode": "122002"}', 1299.00, 1299.00, 'cod', 'completed'),
(5, 'Vikram Gupta', 'vikram.gupta@gmail.com', '+91 98765 43214', '{"address_line_1": "D-504 Park View Residency", "address_line_2": "Sector 62", "city": "Noida", "state": "Uttar Pradesh", "pincode": "201301"}', 2499.00, 2499.00, 'card', 'completed'),
(6, 'Sneha Patel', 'sneha.patel@outlook.com', '+91 98765 43215', '{"address_line_1": "E-105 Royal Gardens", "address_line_2": "Malviya Nagar", "city": "Delhi", "state": "Delhi", "pincode": "110017"}', 1899.00, 1899.00, 'cod', 'processing'),
(7, 'Arjun Kumar', 'arjun.kumar@gmail.com', '+91 98765 43216', '{"address_line_1": "201 Silver Oak Towers", "address_line_2": "MG Road", "city": "Bangalore", "state": "Karnataka", "pincode": "560001"}', 15999.00, 15999.00, 'card', 'confirmed'),
(8, 'Deepika Rao', 'deepika.rao@yahoo.com', '+91 98765 43217', '{"address_line_1": "15 Lajpat Nagar Main Road", "address_line_2": "Near Metro Station", "city": "Delhi", "state": "Delhi", "pincode": "110024"}', 2999.00, 2999.00, 'upi', 'processing'),
(9, 'Rahul Jain', 'rahul.jain@gmail.com', '+91 98765 43218', '{"address_line_1": "F-603 Diamond Heights", "address_line_2": "Sector 51", "city": "Gurugram", "state": "Haryana", "pincode": "122018"}', 12999.00, 12999.00, 'cod', 'completed'),
(10, 'Kavya Nair', 'kavya.nair@hotmail.com', '+91 98765 43219', '{"address_line_1": "45 Koramangala 4th Block", "address_line_2": "Near Forum Mall", "city": "Bangalore", "state": "Karnataka", "pincode": "560034"}', 1999.00, 1999.00, 'upi', 'confirmed'),
(11, 'Siddharth Shah', 'siddharth.shah@outlook.com', '+91 98765 43220', '{"address_line_1": "G-201 Emerald City", "address_line_2": "Sector 65", "city": "Gurugram", "state": "Haryana", "pincode": "122005"}', 1599.00, 1599.00, 'cod', 'completed'),
(12, 'Meera Agarwal', 'meera.agarwal@gmail.com', '+91 98765 43221', '{"address_line_1": "22 Bandra West", "address_line_2": "Near Linking Road", "city": "Mumbai", "state": "Maharashtra", "pincode": "400050"}', 1299.00, 1299.00, 'card', 'processing'),
(13, 'Karan Malhotra', 'karan.malhotra@yahoo.com', '+91 98765 43222', '{"address_line_1": "H-405 Crystal Plaza", "address_line_2": "Cyber City", "city": "Gurugram", "state": "Haryana", "pincode": "122002"}', 999.00, 999.00, 'upi', 'pending');

CREATE TABLE `order_items` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `order_id` bigint(20) UNSIGNED NOT NULL,
 `item_id` bigint(20) UNSIGNED NOT NULL,
 `item_name` varchar(255) NOT NULL,
 `price` decimal(10,2) NOT NULL,
 `quantity` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
 FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order_items` (`order_id`, `item_id`, `item_name`, `price`, `quantity`) VALUES
(1, 1, 'Deep Home Cleaning', 4999.00, 1),
(2, 3, 'AC Service & Repair', 799.00, 1),
(3, 2, 'Classic Manicure & Pedicure', 1299.00, 1),
(4, 5, 'Car Wash & Detailing', 2499.00, 1),
(5, 6, 'Mobile Screen Repair', 1899.00, 1),
(6, 8, 'Living Room Makeover', 15999.00, 1),
(7, 9, 'Personal Fitness Training', 2999.00, 1),
(8, 10, 'Birthday Party Planning', 12999.00, 1),
(9, 11, 'Mathematics Home Tuition', 1999.00, 1),
(10, 12, 'Dog Grooming Service', 1599.00, 1),
(11, 7, 'Cockroach Control Treatment', 1299.00, 1),
(12, 4, 'Organic Cleaning Kit', 999.00, 1),
(1, 13, 'Aromatherapy Massage Oil', 599.00, 1),
(3, 4, 'Organic Cleaning Kit', 999.00, 1),
(5, 13, 'Aromatherapy Massage Oil', 599.00, 2);

CREATE TABLE `contact_form_submissions` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `name` varchar(255) NOT NULL,
 `email` varchar(255) NOT NULL,
 `subject` varchar(255) DEFAULT NULL,
 `message` text NOT NULL,
 `created_at` timestamp NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contact_form_submissions` (`name`, `email`, `subject`, `message`) VALUES
('Priya Sharma', 'priya.sharma@gmail.com', 'Service Quality Feedback', 'I am very happy with the deep cleaning service. The team was professional and thorough.'),
('Rohan Mehta', 'rohan.mehta@yahoo.com', 'AC Service Inquiry', 'Do you provide AC installation services as well? I need to install a new AC unit.'),
('Anjali Singh', 'anjali.singh@hotmail.com', 'Booking Issue', 'I am facing difficulty in booking a slot for beauty services. Please help.'),
('Vikram Gupta', 'vikram.gupta@gmail.com', 'Service Expansion', 'Do you provide services in Ghaziabad? I would like to book car detailing service.'),
('Sneha Patel', 'sneha.patel@outlook.com', 'Payment Query', 'Can I pay using digital wallet for the services? What payment options are available?'),
('Arjun Kumar', 'arjun.kumar@gmail.com', 'Interior Design Quote', 'I need a detailed quote for complete home interior design. Please contact me.'),
('Deepika Rao', 'deepika.rao@yahoo.com', 'Trainer Availability', 'Is the personal trainer available on weekends? I can only workout on Saturday and Sunday.'),
('Rahul Jain', 'rahul.jain@gmail.com', 'Event Planning Services', 'I need help planning an anniversary party for 50 people. What packages do you offer?'),
('Kavya Nair', 'kavya.nair@hotmail.com', 'Tutoring Subjects', 'Do you provide tutoring for science subjects as well? My daughter needs help with physics.'),
('Siddharth Shah', 'siddharth.shah@outlook.com', 'Pet Grooming Frequency', 'How often should I get my dog groomed? What services are included in grooming?'),
('Meera Agarwal', 'meera.agarwal@gmail.com', 'Pest Control Effectiveness', 'The pest control treatment was done 2 weeks ago. How long before I see complete results?'),
('Karan Malhotra', 'karan.malhotra@yahoo.com', 'Bulk Service Discount', 'I need multiple services for my new home. Do you offer package deals or bulk discounts?');

CREATE TABLE `password_reset_tokens` (
 `email` varchar(255) NOT NULL,
 `token` varchar(255) NOT NULL,
 `created_at` timestamp NULL DEFAULT NULL,
 PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
 `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
 `uuid` varchar(255) NOT NULL UNIQUE,
 `connection` text NOT NULL,
 `queue` text NOT NULL,
 `payload` longtext NOT NULL,
 `exception` longtext NOT NULL,
 `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `content` longtext NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pages` (`title`, `slug`, `content`, `is_published`) VALUES
('About Us', 'about-us', '<p>This is the about us page. Welcome to our company! We are dedicated to providing the best services and products to our valued customers. Our team is passionate, dedicated, and always ready to help.</p><p>Founded in 2025, our mission has been to revolutionize the industry with innovative solutions and unparalleled customer support.</p>', 1),
('Privacy Policy', 'privacy-policy', '<h2>1. Information We Collect</h2><p>We collect information you provide directly to us, such as when you create an account, place an order, or contact customer support.</p><h2>2. How We Use Information</h2><p>We use the information we collect to provide, maintain, and improve our services, process transactions, and communicate with you.</p>', 1);


-- SQL for new tables (add to your database)
CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `content` longtext NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `faqs` (`question`, `answer`, `is_active`, `sort_order`) VALUES
('What payment methods do you accept?', 'We currently accept Cash on Delivery (COD). We are working on integrating online payments soon.', 1, 0),
('How can I book a service?', 'You can book a service by selecting the service you need, adding it to your cart, and proceeding to checkout. It''s that simple!', 1, 1);


CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT '5',
  `quote` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `testimonials` (`customer_name`, `location`, `rating`, `quote`, `image_url`, `is_active`) VALUES
('Priya Sharma', 'Delhi, India', 5, 'The cleaning service was phenomenal! My house has never looked this good. The team was professional, punctual, and incredibly thorough. Highly recommended!', 'https://placehold.co/100x100/E2E8F0/4A5568?text=PS', 1),
('Rohan Mehta', 'Mumbai, India', 5, 'Quick and professional AC repair. The technician was very knowledgeable and fixed the issue in no time. I was very impressed with the service.', 'https://placehold.co/100x100/E2E8F0/4A5568?text=RM', 1),
('Anjali Verma', 'Bengaluru, India', 4, 'I bought the organic cleaning kit and it works wonders! It''s effective and I feel good knowing it''s safe for my family and pets.', 'https://placehold.co/100x100/E2E8F0/4A5568?text=AV', 1);


CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_item_unique` (`user_id`,`item_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



ALTER TABLE `users`
ADD `otp` VARCHAR(10) NULL DEFAULT NULL AFTER `password`,
ADD `otp_expires_at` TIMESTAMP NULL DEFAULT NULL AFTER `otp`,
ADD `is_verified` TINYINT(1) NOT NULL DEFAULT 0 AFTER `otp_expires_at`;

-- Also, ensure the password_reset_tokens table exists (it's default in Laravel)
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `carts`
ADD `service_details` TEXT NULL DEFAULT NULL COMMENT 'JSON encoded service details like date, time, location' AFTER `quantity`;

ALTER TABLE `order_items`
ADD `service_details` TEXT NULL DEFAULT NULL COMMENT 'JSON encoded service details' AFTER `quantity`;
