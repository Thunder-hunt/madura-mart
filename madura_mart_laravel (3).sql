-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Bulan Mei 2026 pada 02.51
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `madura_mart_laravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_kirim` datetime NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_pemesanan` bigint(20) UNSIGNED NOT NULL,
  `bukti_foto` varchar(255) NOT NULL,
  `no_invoice` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `distributors`
--

CREATE TABLE `distributors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_distributor` varchar(50) NOT NULL,
  `alamat_distributor` varchar(255) NOT NULL,
  `notelp_distributor` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `distributors`
--

INSERT INTO `distributors` (`id`, `name_distributor`, `alamat_distributor`, `notelp_distributor`, `created_at`, `updated_at`) VALUES
(1, 'PT. ANUGRAH SEJATI ABADI', 'gfyguh,b', '7657689', '2026-04-21 18:11:29', '2026-04-21 18:11:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_12_024309_create_distributors_table', 1),
(5, '2025_11_12_062318_create_products_table', 1),
(6, '2025_11_12_062612_create_purchases_table', 1),
(7, '2025_11_12_062836_create_purchase__details_table', 1),
(8, '2025_11_12_062955_create_sales_table', 1),
(9, '2025_11_12_063232_create_sale__details_table', 1),
(10, '2025_11_12_063247_create_orders_table', 1),
(11, '2025_11_12_063257_create_order__details_table', 1),
(12, '2025_11_12_063335_create_deliveries_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tgl_pemesanan` datetime NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `status_pemesanan` varchar(255) NOT NULL,
  `status` enum('draft','dipesan','diproses','dikirim','sampai tujuan','diterima','selesai','dibatalkan pembeli','dibatalkan penjual') NOT NULL,
  `metode_pembayaran` enum('cod','tf') NOT NULL,
  `total_bayar` int(11) NOT NULL DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order__details`
--

CREATE TABLE `order__details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pemesanan` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `harga_jual` int(11) NOT NULL DEFAULT 0,
  `jumlah_jual` int(11) NOT NULL DEFAULT 0,
  `subtotal` int(11) NOT NULL DEFAULT 0,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_barang` varchar(15) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jenis_barang` varchar(50) NOT NULL,
  `tgl_expired` date NOT NULL,
  `harga_jual` int(11) NOT NULL DEFAULT 0,
  `stok` int(11) NOT NULL DEFAULT 0,
  `foto_barang` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `kd_barang`, `nama_barang`, `jenis_barang`, `tgl_expired`, `harga_jual`, `stok`, `foto_barang`, `created_at`, `updated_at`) VALUES
(4, 'IdmG/01/02/DUS', 'Indomie Goreng', 'Sembako', '2028-10-24', 4400, 10, 'product-images/nIlrPpn4mZuadNvlKOOLZHPFZWl0vXrU6A5U4d2h.jpg', '2026-04-21 20:19:27', '2026-04-21 20:19:27'),
(6, 'IdmG/01/01/DUS', 'Indomie Kari Ayama', 'Sembako', '2068-12-17', 0, 0, 'product-images/YNJ6EyrvyDDoqkVNrlYSU4uoYO6skXphBI37OF7X.jpg', '2026-04-28 17:32:18', '2026-04-28 17:32:18'),
(7, 'Idm/01/03/BSK', 'Indomie Soto', 'Sembako', '2026-12-16', 0, 0, 'product-images/9GnCimgffX8DcGRyKdkvaEhriH8YXNHjNBXPPDhn.jpg', '2026-04-28 17:41:12', '2026-04-28 17:41:12'),
(8, 'TLR/01/01/AYM', 'Telor Ayam', 'Sembako', '2026-04-30', 0, 0, 'product-images/Su1AGlSlk1p99iJ7JPVniHNFQb4oyyMN5MUgGaql.jpg', '2026-04-28 17:44:31', '2026-04-28 17:44:31'),
(9, 'TLR/01/01/BBK', 'Telor Bebek', 'Sembako', '2026-04-30', 0, 0, 'product-images/B5YzANe3HKsOC5v7gkpyIZNHwIOa2Hd3i1quYLnR.jpg', '2026-04-28 17:45:36', '2026-04-28 17:45:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_nota` varchar(20) NOT NULL,
  `tgl_nota` date NOT NULL,
  `id_distributor` bigint(20) UNSIGNED NOT NULL,
  `total_bayar` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `purchases`
--

INSERT INTO `purchases` (`id`, `no_nota`, `tgl_nota`, `id_distributor`, `total_bayar`, `created_at`, `updated_at`) VALUES
(5, '01/022/11', '2026-04-22', 1, 38500, '2026-04-21 20:20:30', '2026-04-21 20:20:30'),
(6, '1100//0111', '2026-04-22', 1, 40000, '2026-04-21 20:21:23', '2026-04-21 20:21:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase__details`
--

CREATE TABLE `purchase__details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pembelian` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `harga_beli` int(11) NOT NULL DEFAULT 0,
  `margin_jual` tinyint(4) NOT NULL DEFAULT 0,
  `jumlah_beli` int(11) NOT NULL DEFAULT 0,
  `subtotal` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `purchase__details`
--

INSERT INTO `purchase__details` (`id`, `id_pembelian`, `id_barang`, `harga_beli`, `margin_jual`, `jumlah_beli`, `subtotal`, `created_at`, `updated_at`) VALUES
(6, 6, 4, 4000, 10, 10, 40000, '2026-04-21 20:21:23', '2026-04-21 20:21:23');

--
-- Trigger `purchase__details`
--
DELIMITER $$
CREATE TRIGGER `hapus_detail_purchase` AFTER DELETE ON `purchase__details` FOR EACH ROW BEGIN
UPDATE products SET stok = stok - Old.jumlah_beli WHERE id = Old.id_barang;
UPDATE purchases SET total_bayar = total_bayar - Old.subtotal WHERE id = Old.id_pembelian;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `simpan_detail_purchase` AFTER INSERT ON `purchase__details` FOR EACH ROW BEGIN
UPDATE products SET harga_jual = New.harga_beli + (New.harga_beli * (New.margin_jual / 100)) , stok = stok + New.jumlah_beli WHERE id = New.id_barang;
UPDATE purchases SET total_bayar = total_bayar + New.subtotal WHERE id = New.id_pembelian;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ubah_detail_purchase` AFTER UPDATE ON `purchase__details` FOR EACH ROW BEGIN
UPDATE products SET harga_jual = New.harga_beli + (New.harga_beli * (New.margin_jual / 100)) , stok = (stok + Old.jumlah_beli) + New.jumlah_beli WHERE id = New.id_barang;
UPDATE purchases SET total_bayar = (total_bayar - Old.subtotal) + New.subtotal WHERE id = New.id_pembelian;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_struk` varchar(255) NOT NULL,
  `tgl_jual` datetime NOT NULL,
  `total_bayar` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sale__details`
--

CREATE TABLE `sale__details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_penjualan` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `harga_jual` int(11) NOT NULL DEFAULT 0,
  `jumlah_jual` int(11) NOT NULL DEFAULT 0,
  `subtotal` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Trigger `sale__details`
--
DELIMITER $$
CREATE TRIGGER `hapus_detail_sale` AFTER DELETE ON `sale__details` FOR EACH ROW BEGIN
UPDATE products SET stok = stok - old.jumlah_jual WHERE id = Old.id_barang;
UPDATE sales SET total_bayar = total_bayar - old.subtotal WHERE id = Old.id_penjualan;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `simpan_detail_sale` AFTER INSERT ON `sale__details` FOR EACH ROW BEGIN
UPDATE products SET stok = stok - New.jumlah_jual WHERE id = New.id_barang;
UPDATE sales SET total_bayar = total_bayar + New.subtotal WHERE id = New.id_penjualan;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ubah_detail_sale` AFTER UPDATE ON `sale__details` FOR EACH ROW BEGIN
UPDATE products SET stok = (stok + old.jumlah_jual) - New.jumlah_jual WHERE id = New.id_barang;
UPDATE sales SET total_bayar = (total_bayar - old.subtotal) + New.subtotal WHERE id = New.id_penjualan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `role` enum('admin','courier','customer','owner') NOT NULL,
  `alamat` text NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vwpurchases`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vwpurchases` (
`id_purchases` bigint(20) unsigned
,`no_nota` varchar(20)
,`tgl_nota` date
,`id_distributor` bigint(20) unsigned
,`name_distributor` varchar(50)
,`id_PD` bigint(20) unsigned
,`id_barang` bigint(20) unsigned
,`nama_barang` varchar(50)
,`jenis_barang` varchar(50)
,`tgl_expired` date
,`harga_jual` int(11)
,`stok` int(11)
,`foto_barang` varchar(255)
,`harga_beli` int(11)
,`margin_jual` tinyint(4)
,`jumlah_beli` int(11)
,`subtotal` bigint(20)
,`total_bayar` bigint(20)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `vwpurchases`
--
DROP TABLE IF EXISTS `vwpurchases`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwpurchases`  AS SELECT `p`.`id` AS `id_purchases`, `p`.`no_nota` AS `no_nota`, `p`.`tgl_nota` AS `tgl_nota`, `p`.`id_distributor` AS `id_distributor`, `d`.`name_distributor` AS `name_distributor`, `pd`.`id` AS `id_PD`, `pd`.`id_barang` AS `id_barang`, `b`.`nama_barang` AS `nama_barang`, `b`.`jenis_barang` AS `jenis_barang`, `b`.`tgl_expired` AS `tgl_expired`, `b`.`harga_jual` AS `harga_jual`, `b`.`stok` AS `stok`, `b`.`foto_barang` AS `foto_barang`, `pd`.`harga_beli` AS `harga_beli`, `pd`.`margin_jual` AS `margin_jual`, `pd`.`jumlah_beli` AS `jumlah_beli`, `pd`.`subtotal` AS `subtotal`, `p`.`total_bayar` AS `total_bayar` FROM (((`purchases` `p` join `purchase__details` `pd`) join `distributors` `d`) join `products` `b`) WHERE `p`.`id_distributor` = `d`.`id` AND `p`.`id` = `pd`.`id_pembelian` AND `pd`.`id_barang` = `b`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deliveries_no_invoice_unique` (`no_invoice`),
  ADD KEY `deliveries_id_user_foreign` (`id_user`),
  ADD KEY `deliveries_id_pemesanan_foreign` (`id_pemesanan`);

--
-- Indeks untuk tabel `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id_user_foreign` (`id_user`);

--
-- Indeks untuk tabel `order__details`
--
ALTER TABLE `order__details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order__details_id_pemesanan_foreign` (`id_pemesanan`),
  ADD KEY `order__details_id_barang_foreign` (`id_barang`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_kd_barang_unique` (`kd_barang`),
  ADD UNIQUE KEY `products_nama_barang_unique` (`nama_barang`);

--
-- Indeks untuk tabel `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchases_no_nota_unique` (`no_nota`),
  ADD KEY `purchases_id_distributor_foreign` (`id_distributor`);

--
-- Indeks untuk tabel `purchase__details`
--
ALTER TABLE `purchase__details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase__details_id_pembelian_foreign` (`id_pembelian`),
  ADD KEY `purchase__details_id_barang_foreign` (`id_barang`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_no_struk_unique` (`no_struk`);

--
-- Indeks untuk tabel `sale__details`
--
ALTER TABLE `sale__details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale__details_id_penjualan_foreign` (`id_penjualan`),
  ADD KEY `sale__details_id_barang_foreign` (`id_barang`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order__details`
--
ALTER TABLE `order__details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `purchase__details`
--
ALTER TABLE `purchase__details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sale__details`
--
ALTER TABLE `sale__details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_id_pemesanan_foreign` FOREIGN KEY (`id_pemesanan`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deliveries_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order__details`
--
ALTER TABLE `order__details`
  ADD CONSTRAINT `order__details_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order__details_id_pemesanan_foreign` FOREIGN KEY (`id_pemesanan`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_id_distributor_foreign` FOREIGN KEY (`id_distributor`) REFERENCES `distributors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `purchase__details`
--
ALTER TABLE `purchase__details`
  ADD CONSTRAINT `purchase__details_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase__details_id_pembelian_foreign` FOREIGN KEY (`id_pembelian`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sale__details`
--
ALTER TABLE `sale__details`
  ADD CONSTRAINT `sale__details_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sale__details_id_penjualan_foreign` FOREIGN KEY (`id_penjualan`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
