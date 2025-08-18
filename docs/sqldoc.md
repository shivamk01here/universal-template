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
