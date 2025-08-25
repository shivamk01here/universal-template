-- Create database
CREATE DATABASE IF NOT EXISTS `laravel_universal` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `laravel_universal`;

-- Users table
CREATE TABLE `users` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password` varchar(255) NOT NULL,
    `otp` varchar(10) NULL DEFAULT NULL,
    `otp_expires_at` timestamp NULL DEFAULT NULL,
    `is_verified` tinyint(1) NOT NULL DEFAULT 0,
    `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
    `remember_token` varchar(100) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Categories table
CREATE TABLE `categories` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `slug` varchar(255) NOT NULL,
    `description` text DEFAULT NULL,
    `image_url` varchar(255) DEFAULT NULL,
    `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `categories_slug_unique` (`slug`),
    KEY `categories_parent_id_foreign` (`parent_id`),
    FOREIGN KEY (`parent_id`) REFERENCES `categories`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Items table
CREATE TABLE `items` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `slug` varchar(255) NOT NULL,
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
    UNIQUE KEY `items_slug_unique` (`slug`),
    KEY `items_category_id_foreign` (`category_id`),
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Item images table
CREATE TABLE `item_images` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `item_id` bigint(20) UNSIGNED NOT NULL,
    `image_url` varchar(255) NOT NULL,
    `alt_text` varchar(255) DEFAULT NULL,
    `is_primary` tinyint(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    KEY `item_images_item_id_foreign` (`item_id`),
    FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Attributes table
CREATE TABLE `attributes` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `type` varchar(50) NOT NULL DEFAULT 'text',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Item attributes table
CREATE TABLE `item_attributes` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `item_id` bigint(20) UNSIGNED NOT NULL,
    `attribute_id` bigint(20) UNSIGNED NOT NULL,
    `value` text NOT NULL,
    PRIMARY KEY (`id`),
    KEY `item_attributes_item_id_foreign` (`item_id`),
    KEY `item_attributes_attribute_id_foreign` (`attribute_id`),
    FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`attribute_id`) REFERENCES `attributes`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Site settings table
CREATE TABLE `site_settings` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `key` varchar(255) NOT NULL,
    `value` text DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



--example of site setting 
''site_name	Bhagyavidhan
site_logo_url	logo_68a31c115e203_1755520017.jpg
contact_emailsupport@bhagyavidhan.com
contact_phone	+91 98765 43210
footer_about_us	Bhagyavidhan is your one-stop solution for all home and personal care needs. We connect you with trusted professionals to make your life easier.
footer_copyright	© 2025 Bhagyavidhan. All Rights Reserved.
company_address	123 Service Street, Gurugram, Haryana 122001
support_hours	Monday to Sunday: 8:00 AM - 10:00 PM
social_facebook	https://facebook.com/bhagyavidhan
social_instagram	https://instagram.com/bhagyavidhan
social_twitter	https://twitter.com/bhagyavidhan
whatsapp_number	+91 98765 43210
primary_color	#3485fd
primary_color_code	#3485fd
secondary_color	#13c7a7
secondary_color_code	#13c7a7
button_color	#5971f6
button_color_code	#5971f6
background_color	#ffffff
background_color_code	#ffffff
custom_css	
site_logo	logo_68a31749c1b7a_1755518793.png

-- Page sections table
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

-- Sliders table
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

-- Reviews table
CREATE TABLE `reviews` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `item_id` bigint(20) UNSIGNED NOT NULL,
    `user_id` bigint(20) UNSIGNED NOT NULL,
    `rating` tinyint(3) UNSIGNED NOT NULL,
    `comment` text DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`),
    KEY `reviews_item_id_foreign` (`item_id`),
    KEY `reviews_user_id_foreign` (`user_id`),
    FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- User addresses table
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
    KEY `user_addresses_user_id_foreign` (`user_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Orders table
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
    KEY `orders_user_id_foreign` (`user_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Order items table
CREATE TABLE `order_items` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `order_id` bigint(20) UNSIGNED NOT NULL,
    `item_id` bigint(20) UNSIGNED NOT NULL,
    `item_name` varchar(255) NOT NULL,
    `price` decimal(10,2) NOT NULL,
    `quantity` int(11) NOT NULL,
    `service_details` text DEFAULT NULL COMMENT 'JSON encoded service details',
    PRIMARY KEY (`id`),
    KEY `order_items_order_id_foreign` (`order_id`),
    KEY `order_items_item_id_foreign` (`item_id`),
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact form submissions table
CREATE TABLE `contact_form_submissions` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `subject` varchar(255) DEFAULT NULL,
    `message` text NOT NULL,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Password reset tokens table
CREATE TABLE `password_reset_tokens` (
    `email` varchar(255) NOT NULL,
    `token` varchar(255) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Failed jobs table
CREATE TABLE `failed_jobs` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid` varchar(255) NOT NULL,
    `connection` text NOT NULL,
    `queue` text NOT NULL,
    `payload` longtext NOT NULL,
    `exception` longtext NOT NULL,
    `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pages table
CREATE TABLE `pages` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `slug` varchar(255) NOT NULL,
    `content` longtext NOT NULL,
    `is_published` tinyint(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Blogs table
CREATE TABLE `blogs` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `slug` varchar(255) NOT NULL,
    `content` longtext NOT NULL,
    `image_url` varchar(255) DEFAULT NULL,
    `is_published` tinyint(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `blogs_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- FAQs table
CREATE TABLE `faqs` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `question` varchar(255) NOT NULL,
    `answer` text NOT NULL,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `sort_order` int(11) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Testimonials table
CREATE TABLE `testimonials` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `customer_name` varchar(255) NOT NULL,
    `location` varchar(255) DEFAULT NULL,
    `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT 5,
    `quote` text NOT NULL,
    `image_url` varchar(255) DEFAULT NULL,
    `is_active` tinyint(1) NOT NULL DEFAULT 1,
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Carts table
CREATE TABLE `carts` (
    `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` bigint(20) UNSIGNED NOT NULL,
    `item_id` bigint(20) UNSIGNED NOT NULL,
    `quantity` int(11) NOT NULL,
    `service_details` text DEFAULT NULL COMMENT 'JSON encoded service details like date, time, location',
    `created_at` timestamp NULL DEFAULT current_timestamp(),
    `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `user_item_unique` (`user_id`,`item_id`),
    KEY `carts_user_id_foreign` (`user_id`),
    KEY `carts_item_id_foreign` (`item_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`item_id`) REFERENCES `items`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`name`, `email`, `email_verified_at`, `password`, `is_verified`, `role`) VALUES
('Admin User', 'admin@bhagyavidhan.com', '2025-01-01 10:00:00', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 'admin');


-- Add a new column to differentiate section types
ALTER TABLE `page_sections` ADD `section_type` VARCHAR(50) NOT NULL DEFAULT 'default' AFTER `section_slug`;

-- Ensure the content column can hold a lot of HTML
ALTER TABLE `page_sections` CHANGE `content` `content` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;

-- Migrate existing sections to use the new type system
UPDATE `page_sections` SET `section_type` = `section_slug`;

-- Insert rows for the sections that were previously hard-coded, so you can control them
INSERT INTO `page_sections` (`page_slug`, `section_slug`, `section_type`, `title`, `subtitle`, `is_active`, `sort_order`) VALUES
('homepage', 'featured-services', 'featured-services', 'Featured Services', 'Top services handpicked for you.', 1, 2),
('homepage', 'featured-products', 'featured-products', 'Featured Products', 'Check out our best-selling products.', 1, 3),
('homepage', 'latest-blogs', 'latest-blogs', 'From Our Blog', 'Latest articles and insights from our team.', 1, 5),
('homepage', 'faq', 'faq', 'Common Questions', NULL, 1, 6);

-- Update the sort order for better initial layout
UPDATE `page_sections` SET `sort_order` = 1 WHERE `section_slug` = 'hero';
UPDATE `page_sections` SET `sort_order` = 4 WHERE `section_slug` = 'testimonials';


ALTER TABLE blogs CHANGE image_url image VARCHAR(255) DEFAULT NULL;


-- Add new columns to control the appearance of each section
ALTER TABLE `page_sections`
ADD `layout_template` VARCHAR(100) NOT NULL DEFAULT 'default' AFTER `section_slug`,
ADD `bg_image` VARCHAR(255) NULL DEFAULT NULL AFTER `content`,
ADD `bg_color` VARCHAR(50) NULL DEFAULT NULL AFTER `bg_image`;

-- Clear out old homepage sections to start fresh for the /main page
DELETE FROM `page_sections` WHERE `page_slug` = 'homepage';

-- Insert the default, controllable sections for the new /main page
INSERT INTO `page_sections` (`page_slug`, `section_slug`, `layout_template`, `title`, `subtitle`, `content`, `bg_image`, `bg_color`, `is_active`, `sort_order`) VALUES
('main', 'hero-banner', 'hero-center', 'Welcome to Your Store', 'This is a fully editable subtitle.', '{\"button_text\":\"Explore Now\",\"button_link\":\"/items\"}', NULL, '#f9fafb', 1, 1),
('main', 'featured-services', 'item-grid', 'Our Premier Services', 'Handpicked services to meet your needs.', '{\"item_type\":\"SERVICE\",\"limit\":4}', NULL, '#ffffff', 1, 2),
('main', 'featured-products', 'item-grid', 'Top Selling Products', 'Customer favorites you don\'t want to miss.', '{\"item_type\":\"PRODUCT\",\"limit\":4}', NULL, '#f9fafb', 1, 3),
('main', 'testimonials', 'testimonial-slider', 'What Our Clients Say', 'Real stories from our satisfied customers.', NULL, NULL, '#ffffff', 1, 4),
('main', 'latest-blogs', 'blog-grid', 'From Our Blog', 'Latest articles and insights from our team.', '{\"limit\":3}', NULL, '#f9fafb', 1, 5),
('main', 'faq', 'faq-accordion', 'Common Questions', 'Everything you need to know.', NULL, NULL, '#ffffff', 1, 6);

alter table page_sections add column image varchar(255) after bg_color;
	









<!-- 
 -->
 --
CREATE TABLE `homepages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepages`
--
INSERT INTO `homepages` (`id`, `name`, `is_active`, `is_default`) VALUES
(1, 'Default App Landing Page', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `homepage_sections`
--
CREATE TABLE `homepage_sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `homepage_id` int(10) UNSIGNED NOT NULL,
  `section_slug` varchar(100) NOT NULL,
  `template_id` varchar(100) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`content`)),
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepage_sections`
--
INSERT INTO `homepage_sections` (`id`, `homepage_id`, `section_slug`, `template_id`, `display_order`, `content`, `is_visible`) VALUES
(1, 1, 'hero', 'template-1', 0, '{\"heading\":\"High Converting Heading Comes Here\",\"subheading\":\"Hook your visitors instantly with a clear headline, value prop, and a visually engaging image to create a powerful first impression.\",\"primary_cta_text\":\"Get Started Now\",\"primary_cta_link\":\"#\",\"primary_cta_bg_color\":\"#4f46e5\",\"secondary_cta_text\":\"Contact Sales\",\"secondary_cta_link\":\"#\",\"secondary_cta_bg_color\":\"#4b5563\",\"main_image_url\":\"https://placehold.co/600x400/e2e8f0/64748b?text=Feature+Image\",\"bg_color\":\"#ffffff\",\"bg_image_url\":\"\"}', 1),
(2, 1, 'partners', 'template-1', 1, '{\"heading\":\"WE ARE PARTNERED WITH AMAZING COMPANIES\",\"logos\":[\"https://placehold.co/100x50/cccccc/969696?text=Logo1\",\"https://placehold.co/100x50/cccccc/969696?text=Logo2\",\"https://placehold.co/100x50/cccccc/969696?text=Logo3\",\"https://placehold.co/100x50/cccccc/969696?text=Logo4\",\"https://placehold.co/100x50/cccccc/969696?text=Logo5\"],\"bg_color\":\"#f9fafb\",\"bg_image_url\":\"\"}', 1),
(3, 1, 'features', 'template-1', 2, '{\"heading\":\"Discover Our Amazing Features\",\"subheading\":\"Our platform is packed with features designed to boost your productivity and streamline your workflow.\",\"features\":[{\"title\":\"Real-Time Collaboration\",\"description\":\"Work with your team in real-time. Changes are synced instantly across all devices.\",\"image_url\":\"https://placehold.co/500x300/e2e8f0/64748b?text=Feature+1\"},{\"title\":\"Advanced Analytics\",\"description\":\"Gain valuable insights with our advanced analytics dashboard. Track your progress and make data-driven decisions.\",\"image_url\":\"https://placehold.co/500x300/e2e8f0/64748b?text=Feature+2\"}],\"bg_color\":\"#ffffff\",\"bg_image_url\":\"\"}', 1),
(4, 1, 'testimonials', 'template-1', 4, '{\"heading\":\"What People Say About Us\",\"subheading\":\"Let happy users convince the rest. Social proof is a powerful tool to build trust and credibility.\",\"bg_color\":\"#f9fafb\",\"bg_image_url\":\"\"}', 1),
(5, 1, 'faq', 'template-1', 6, '{\"heading\":\"Frequently Asked Questions\",\"subheading\":\"Address common concerns to eliminate friction and make the decision to sign up an easy one.\",\"bg_color\":\"#ffffff\",\"bg_image_url\":\"\"}', 1),
(6, 1, 'cta', 'template-1', 8, '{\"heading\":\"Get Started with Our App Today!\",\"subheading\":\"Wrap up with a powerful final call to action. This is your last chance to convert a visitor into a customer.\",\"primary_cta_text\":\"Sign Up For Free\",\"primary_cta_link\":\"#\",\"primary_cta_bg_color\":\"#4f46e5\",\"bg_color\":\"#f3f4f6\",\"bg_image_url\":\"\"}', 1),
(7, 1, 'blog', 'template-1', 7, '{\"heading\":\"From Our Blog\",\"subheading\":\"Stay updated with the latest industry trends, tips, and company news.\",\"bg_color\":\"#ffffff\",\"bg_image_url\":\"\"}', 1),
(8, 1, 'products', 'template-1', 3, '{\"heading\":\"Check Out Our Products\",\"subheading\":\"We have a wide range of products that are designed to meet your needs.\",\"bg_color\":\"#ffffff\",\"bg_image_url\":\"\"}', 1),
(9, 1, 'services', 'template-1', 5, '{\"heading\":\"Services We Offer\",\"subheading\":\"Our services are designed to help you achieve your goals and grow your business.\",\"bg_color\":\"#f9fafb\",\"bg_image_url\":\"\"}', 1),
(10, 1, 'hero', 'template-2', 9, '{\"heading\":\"Another Powerful Headline\",\"subheading\":\"This is a different hero layout with a centered approach, perfect for impactful statements.\",\"primary_cta_text\":\"Explore Features\",\"primary_cta_link\":\"#features\",\"primary_cta_bg_color\":\"#db2777\",\"bg_color\":\"#111827\",\"bg_image_url\":\"https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80\"}', 0),
(11, 1, 'hero', 'template-3', 10, '{\"heading\":\"Simple, Elegant, Effective.\",\"subheading\":\"A clean and minimal hero section that puts all the focus on your message.\",\"primary_cta_text\":\"Learn More\",\"primary_cta_link\":\"#\",\"primary_cta_bg_color\":\"#16a34a\",\"bg_color\":\"#f1f5f9\",\"bg_image_url\":\"\"}', 0);