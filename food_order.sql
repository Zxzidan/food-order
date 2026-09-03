-- ========================================================
-- Database Export for InfinityFree / MySQL phpMyAdmin
-- Project: Food Order (SIPEMMA)
-- Generated at: 2026-09-03 06:03:57
-- ========================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Table structure for table `users`
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for table `password_reset_tokens`
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for table `sessions`
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for table `categories`
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for table `menus`
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sold` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_category_id_foreign` (`category_id`),
  CONSTRAINT `menus_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for table `restaurant_tables`
DROP TABLE IF EXISTS `restaurant_tables`;
CREATE TABLE `restaurant_tables` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `table_number` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT 4,
  `status` enum('available','occupied','reserved') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `restaurant_tables_table_number_unique` (`table_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for table `orders`
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL DEFAULT 'Umum',
  `order_type` varchar(50) NOT NULL DEFAULT 'Dine In',
  `table_number` varchar(255) DEFAULT NULL,
  `subtotal` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `tax` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `discount` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `total_amount` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'pending',
  `midtrans_payment_type` varchar(50) DEFAULT NULL,
  `cash_received` bigint(20) UNSIGNED DEFAULT NULL,
  `change_amount` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Menunggu Pembayaran',
  `notes` text DEFAULT NULL,
  `midtrans_transaction_id` varchar(255) DEFAULT NULL,
  `midtrans_status` varchar(255) DEFAULT NULL,
  `midtrans_transaction_time` timestamp NULL DEFAULT NULL,
  `midtrans_settlement_time` timestamp NULL DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_midtrans_transaction_id_index` (`midtrans_transaction_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for table `order_items`
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `menu_name` varchar(255) NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `subtotal` bigint(20) UNSIGNED NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table structure for table `migrations`
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'Dandi Azaidane', 'admin@sipemma.com', NULL, '$2y$12$.lmvI5sa.Nq6qVQFF4ugO.DHRb96Ocypqq7tFemBMJ8Iwtowcjgxi', 'admin', 'https://flowbite.com/docs/images/people/profile-picture-5.jpg', '44GgBwFkSJ8cw7buOHxFqC4TIiNjPx1b05CtLJrPyrCS3Vfh7Fwki4O5tNQS', '2026-09-01 13:29:07', '2026-09-03 04:41:04');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES (2, 'Kasir Resto', 'kasir@sipemma.com', NULL, '$2y$12$Gmta0jisAfQRClDxhGEhq.e8.OIScdK5IqROkUcr/9NE.Tlfk5.rK', 'cashier', NULL, NULL, '2026-09-03 04:41:05', '2026-09-03 04:41:05');

-- Dumping data for table `categories`
INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `created_at`, `updated_at`) VALUES (1, 'Makanan', 'makanan', 'food', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `created_at`, `updated_at`) VALUES (2, 'Minuman', 'minuman', 'drink', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `created_at`, `updated_at`) VALUES (3, 'Snack', 'snack', 'snack', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `created_at`, `updated_at`) VALUES (4, 'Dessert', 'dessert', 'dessert', '2026-09-03 04:41:05', '2026-09-03 04:41:05');

-- Dumping data for table `menus`
INSERT INTO `menus` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `sold`, `image`, `is_available`, `created_at`, `updated_at`) VALUES (1, 1, 'Nasi Goreng Ayam', 'Nasi goreng dengan telur, ayam suwir, udang, dan bumbu spesial.', 35000, 25, 98, 'assets/img/NASI GORENG AYAM.jpg', 1, '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `menus` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `sold`, `image`, `is_available`, `created_at`, `updated_at`) VALUES (2, 1, 'Mie Goreng Spesial', 'Mie goreng lezat dengan isian ayam cincang, sawi, pangsit dan bumbu rahasia.', 40000, 18, 124, 'assets/img/MIE AYAM.jpeg', 1, '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `menus` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `sold`, `image`, `is_available`, `created_at`, `updated_at`) VALUES (3, 2, 'Es Jeruk Segar', 'Perasan buah jeruk segar asli murni dengan es batu yang menyegarkan dahaga.', 12000, 40, 85, 'assets/img/ES JERUK.jpg', 1, '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `menus` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `sold`, `image`, `is_available`, `created_at`, `updated_at`) VALUES (4, 1, 'Gado-Gado', 'Sayuran segar dengan bumbu kacang gurih khas resep tradisional dan kerupuk.', 25000, 15, 64, 'assets/img/GADO GADO.jpg', 1, '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `menus` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `sold`, `image`, `is_available`, `created_at`, `updated_at`) VALUES (5, 2, 'Es Teh Manis', 'Teh melati wangi dengan es batu dingin menyegarkan.', 6000, 50, 210, NULL, 1, '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `menus` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `sold`, `image`, `is_available`, `created_at`, `updated_at`) VALUES (6, 3, 'Kentang Goreng Crispy', 'Kentang goreng renyah dengan taburan saus keju dan bumbu gurih.', 18000, 30, 45, NULL, 1, '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `menus` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `sold`, `image`, `is_available`, `created_at`, `updated_at`) VALUES (7, 4, 'Pisang Bakar Coklat Keju', 'Pisang kepok bakar manis dengan topping keju parut dan lelehan cokelat.', 20000, 20, 38, NULL, 1, '2026-09-03 04:41:05', '2026-09-03 04:41:05');

-- Dumping data for table `restaurant_tables`
INSERT INTO `restaurant_tables` (`id`, `table_number`, `capacity`, `status`, `created_at`, `updated_at`) VALUES (1, 'Meja 01', 2, 'available', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `restaurant_tables` (`id`, `table_number`, `capacity`, `status`, `created_at`, `updated_at`) VALUES (2, 'Meja 02', 4, 'available', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `restaurant_tables` (`id`, `table_number`, `capacity`, `status`, `created_at`, `updated_at`) VALUES (3, 'Meja 03', 6, 'available', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `restaurant_tables` (`id`, `table_number`, `capacity`, `status`, `created_at`, `updated_at`) VALUES (4, 'Meja 04', 4, 'available', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `restaurant_tables` (`id`, `table_number`, `capacity`, `status`, `created_at`, `updated_at`) VALUES (5, 'Meja 05', 2, 'available', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `restaurant_tables` (`id`, `table_number`, `capacity`, `status`, `created_at`, `updated_at`) VALUES (6, 'Meja 06', 6, 'available', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `restaurant_tables` (`id`, `table_number`, `capacity`, `status`, `created_at`, `updated_at`) VALUES (7, 'Meja 07', 2, 'available', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `restaurant_tables` (`id`, `table_number`, `capacity`, `status`, `created_at`, `updated_at`) VALUES (8, 'Meja 08', 4, 'available', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `restaurant_tables` (`id`, `table_number`, `capacity`, `status`, `created_at`, `updated_at`) VALUES (9, 'Meja 09', 6, 'available', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `restaurant_tables` (`id`, `table_number`, `capacity`, `status`, `created_at`, `updated_at`) VALUES (10, 'Meja 10', 4, 'available', '2026-09-03 04:41:05', '2026-09-03 04:41:05');

-- Dumping data for table `orders`
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `order_type`, `table_number`, `subtotal`, `tax`, `discount`, `total_amount`, `payment_method`, `payment_status`, `cash_received`, `change_amount`, `status`, `notes`, `created_at`, `updated_at`, `midtrans_transaction_id`, `midtrans_status`, `midtrans_payment_type`, `midtrans_transaction_time`, `midtrans_settlement_time`, `snap_token`) VALUES (2, '#ORD-20260822-045', 1, 'Ahmad Fauzi', 'Dine In', 'Meja 04', 50000, 5000, 0, 55000, 'QRIS', 'paid', NULL, NULL, 'Selesai', 'Tanpa bawang goreng di mie', '2026-09-03 04:11:05', '2026-09-03 04:11:05', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `order_type`, `table_number`, `subtotal`, `tax`, `discount`, `total_amount`, `payment_method`, `payment_status`, `cash_received`, `change_amount`, `status`, `notes`, `created_at`, `updated_at`, `midtrans_transaction_id`, `midtrans_status`, `midtrans_payment_type`, `midtrans_transaction_time`, `midtrans_settlement_time`, `snap_token`) VALUES (3, '#ORD-20260822-044', 1, 'Siti Nurhaliza', 'Take Away', NULL, 47000, 4700, 0, 51700, 'Tunai', 'paid', 60000, 8300, 'Selesai', 'Bungkus rapi', '2026-09-03 03:41:05', '2026-09-03 03:41:05', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `order_type`, `table_number`, `subtotal`, `tax`, `discount`, `total_amount`, `payment_method`, `payment_status`, `cash_received`, `change_amount`, `status`, `notes`, `created_at`, `updated_at`, `midtrans_transaction_id`, `midtrans_status`, `midtrans_payment_type`, `midtrans_transaction_time`, `midtrans_settlement_time`, `snap_token`) VALUES (4, '#ORD-20260822-043', 1, 'Budi Santoso', 'Dine In', 'Meja 08', 69000, 6900, 0, 75900, 'QRIS', 'paid', NULL, NULL, 'Diproses', 'Bumbu gado-gado pedas', '2026-09-03 02:41:05', '2026-09-03 02:41:05', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `order_type`, `table_number`, `subtotal`, `tax`, `discount`, `total_amount`, `payment_method`, `payment_status`, `cash_received`, `change_amount`, `status`, `notes`, `created_at`, `updated_at`, `midtrans_transaction_id`, `midtrans_status`, `midtrans_payment_type`, `midtrans_transaction_time`, `midtrans_settlement_time`, `snap_token`) VALUES (5, '#ORD-20260822-042', 1, 'Dewi Lestari', 'Dine In', 'Meja 02', 40000, 4000, 0, 44000, 'Debit', 'paid', NULL, NULL, 'Selesai', NULL, '2026-09-03 01:41:05', '2026-09-03 01:41:05', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `order_type`, `table_number`, `subtotal`, `tax`, `discount`, `total_amount`, `payment_method`, `payment_status`, `cash_received`, `change_amount`, `status`, `notes`, `created_at`, `updated_at`, `midtrans_transaction_id`, `midtrans_status`, `midtrans_payment_type`, `midtrans_transaction_time`, `midtrans_settlement_time`, `snap_token`) VALUES (6, '#ORD-20260822-041', 1, 'Reza Rahardian', 'Take Away', NULL, 72000, 7200, 0, 79200, 'Tunai', 'paid', 100000, 20800, 'Selesai', 'Porsi banyak sambal', '2026-09-03 00:41:05', '2026-09-03 00:41:05', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `order_type`, `table_number`, `subtotal`, `tax`, `discount`, `total_amount`, `payment_method`, `payment_status`, `cash_received`, `change_amount`, `status`, `notes`, `created_at`, `updated_at`, `midtrans_transaction_id`, `midtrans_status`, `midtrans_payment_type`, `midtrans_transaction_time`, `midtrans_settlement_time`, `snap_token`) VALUES (7, '#ORD-20260822-040', 1, 'Rina Wijaya', 'Dine In', 'Meja 05', 38000, 3800, 0, 41800, 'QRIS', 'paid', NULL, NULL, 'Selesai', NULL, '2026-09-02 23:41:05', '2026-09-02 23:41:05', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `order_type`, `table_number`, `subtotal`, `tax`, `discount`, `total_amount`, `payment_method`, `payment_status`, `cash_received`, `change_amount`, `status`, `notes`, `created_at`, `updated_at`, `midtrans_transaction_id`, `midtrans_status`, `midtrans_payment_type`, `midtrans_transaction_time`, `midtrans_settlement_time`, `snap_token`) VALUES (8, 'ORD-20260903-0006', 1, 'Umum', 'Dine In', 'Meja 01', 35000, 3500, 0, 38500, 'QRIS', 'paid', NULL, NULL, 'Diproses', NULL, '2026-09-03 05:03:54', '2026-09-03 05:06:08', '7f0ace03-83e7-4950-aeb8-d1532a3ed040', NULL, 'qris', NULL, NULL, '6cdc6f50-ea0a-461e-8780-409204c9b96c');
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `order_type`, `table_number`, `subtotal`, `tax`, `discount`, `total_amount`, `payment_method`, `payment_status`, `cash_received`, `change_amount`, `status`, `notes`, `created_at`, `updated_at`, `midtrans_transaction_id`, `midtrans_status`, `midtrans_payment_type`, `midtrans_transaction_time`, `midtrans_settlement_time`, `snap_token`) VALUES (9, 'ORD-20260903-0007', 1, 'KONTOL 2', 'Dine In', 'MEMEK', 25000, 2500, 0, 27500, 'QRIS', 'pending', NULL, NULL, 'Menunggu Pembayaran', NULL, '2026-09-03 05:07:46', '2026-09-03 05:07:50', NULL, NULL, NULL, NULL, NULL, '56fe5bd3-8e78-470f-87b9-1591550d22a0');
INSERT INTO `orders` (`id`, `order_number`, `user_id`, `customer_name`, `order_type`, `table_number`, `subtotal`, `tax`, `discount`, `total_amount`, `payment_method`, `payment_status`, `cash_received`, `change_amount`, `status`, `notes`, `created_at`, `updated_at`, `midtrans_transaction_id`, `midtrans_status`, `midtrans_payment_type`, `midtrans_transaction_time`, `midtrans_settlement_time`, `snap_token`) VALUES (10, 'ORD-20260903-0008', 1, 'Umum', 'Dine In', 'Meja 01', 35000, 3500, 0, 38500, 'QRIS', 'paid', NULL, NULL, 'Diproses', NULL, '2026-09-03 05:08:38', '2026-09-03 05:09:17', '52e1b092-e2ce-4694-824f-5fe7b80149c0', NULL, 'bank_transfer', NULL, NULL, 'dce5ab3c-6c71-481a-8b73-5a565b3229f6');

-- Dumping data for table `order_items`
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (1, 2, 2, 'Mie Goreng Spesial', 18000, 2, 36000, 'Pedas sedang', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (2, 2, 3, 'Es Jeruk Segar', 7000, 2, 14000, 'Sedikit es', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (3, 3, 1, 'Nasi Goreng Ayam', 35000, 1, 35000, NULL, '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (4, 3, 3, 'Es Jeruk Segar', 12000, 1, 12000, NULL, '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (5, 4, 4, 'Gado-Gado Spesial', 16000, 3, 48000, 'Bumbu dipisah', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (6, 4, 3, 'Es Jeruk Segar', 7000, 3, 21000, NULL, '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (7, 5, 1, 'Nasi Goreng Ayam', 20000, 2, 40000, 'Pedas sedang', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (8, 6, 2, 'Mie Goreng Spesial', 18000, 4, 72000, 'Extra pangsit', '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (9, 7, 6, 'Kentang Goreng Crispy', 18000, 1, 18000, NULL, '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (10, 7, 7, 'Pisang Bakar Coklat Keju', 20000, 1, 20000, NULL, '2026-09-03 04:41:05', '2026-09-03 04:41:05');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (11, 8, 1, 'Nasi Goreng Ayam', 35000, 1, 35000, '', '2026-09-03 05:03:54', '2026-09-03 05:03:54');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (12, 9, 4, 'Gado-Gado', 25000, 1, 25000, 'Kontol 1', '2026-09-03 05:07:46', '2026-09-03 05:07:46');
INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `menu_name`, `price`, `quantity`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES (13, 10, 1, 'Nasi Goreng Ayam', 35000, 1, 35000, '', '2026-09-03 05:08:38', '2026-09-03 05:08:38');

-- Dumping data for table `migrations`
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2, '2026_08_28_000001_create_categories_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3, '2026_08_28_000002_create_menus_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4, '2026_08_28_000003_create_restaurant_tables_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5, '2026_08_28_000004_create_orders_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6, '2026_08_28_000005_create_order_items_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7, '2026_09_01_021353_add_midtrans_columns_to_orders', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8, '2026_09_01_234225_update_payment_columns_on_orders_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9, '2026_09_02_001223_drop_invoice_number_from_orders_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10, '2026_09_02_005557_change_status_to_string_on_orders_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11, '2026_09_02_010000_add_snap_token_to_orders_table', 3);

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;
