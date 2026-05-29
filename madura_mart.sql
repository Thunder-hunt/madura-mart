-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Bulan Mei 2026 pada 03.06
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
-- Database: `madura_mart`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kd_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jenis_barang` varchar(50) NOT NULL,
  `tgl_expired` date DEFAULT NULL,
  `harga_jual` int(11) DEFAULT 0,
  `stok` int(11) DEFAULT 0,
  `foto_barang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kd_barang`, `nama_barang`, `jenis_barang`, `tgl_expired`, `harga_jual`, `stok`, `foto_barang`) VALUES
('DMS/01234/', 'Sari Gandum Cokelat 108g', 'Cemilan', '2027-01-01', 32500, 22, 'sargancok108g.jpg'),
('DMS/01235/', 'Roma Malkist Chocolate 90g', 'Cemilan', '2027-01-02', 11700, 28, 'Rokistcho90g.jpg'),
('DMS/01236/', 'Shampoo Sunsilk 160g', 'Peralatan mandi', '2027-01-03', 2300, 19, 'ShaSu160g.jpg'),
('DMS/01237/', 'Roma Arden Chocolate 90g', 'Cemilan', '2027-01-04', 3450, 26, 'RodenCho90g.jpg'),
('DMS/01238/', 'Yupi Dinosaurus 20g', 'Cemilan', '2027-01-05', 2300, 18, 'YuDi20g.jpg'),
('DMS/01239/', 'Kitkat Vanilla 45g', 'Cemilan', '2027-01-06', 3450, 27, 'KitVa45g.jpg'),
('DMS/01241/', 'Nipis Madu 80g', 'Minuman Ringan', '2027-01-07', 7000, 0, 'NiMa80g.jpg'),
('DMS/01242/', 'Ale-ale Madu 40g', 'Minuman Ringan', '2027-01-08', 3450, 45, 'Alma40g.jpg'),
('PT/0925/01', 'Pepsodent Perawat Gusi 100g', 'Peralatan mandi', '2028-02-16', 13000, 21, 'pepsodent.jpg'),
('PT/0925/11', 'Lefi Ganteng 10kg', 'Mainan', '2028-02-29', 5000, 0, 'LefGan10kg.jpg'),
('SM/0925/01', 'Dettol Body Wash 180ml', 'Peralatan mandi', '2029-10-19', 11700, 10, 'dettol cair 180ml.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `no_nota` varchar(15) DEFAULT NULL,
  `kd_barang` varchar(10) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT 0,
  `margin_jual` smallint(6) DEFAULT 0,
  `jumlah_beli` int(11) DEFAULT 0,
  `subtotal` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`no_nota`, `kd_barang`, `harga_beli`, `margin_jual`, `jumlah_beli`, `subtotal`) VALUES
('0925/P/1/0001', 'DMS/01234/', 100000, 30, 10, 1000000),
('1025/P/1/0001', 'PT/0925/01', 10000, 30, 4, 200000),
('1025/P/1/0002', 'PT/0925/01', 10000, 30, 8, 80000),
('2025/P/1/0001', 'DMS/01234/', 100000, 30, 10, 1000000),
('2025/P/1/0001', 'PT/0925/01', 10000, 30, 12, 120000),
('2025/P/1/0002', 'SM/0925/01', 9000, 30, 15, 135000),
('2025/P/1/0002', 'DMS/01235/', 12000, 30, 20, 240000),
('0525/P/1/0001', 'PT/0925/01', 10000, 30, 10, 100000),
('0525/P/1/0002', 'DMS/01234/', 25000, 30, 6, 150000),
('0525/P/1/0002', 'DMS/01235/', 9000, 30, 10, 90000),
('0525/P/1/0003', 'DMS/01236/', 2000, 15, 24, 48000),
('0525/P/1/0003', 'DMS/01237/', 3000, 15, 32, 96000),
('0525/P/1/0003', 'DMS/01238/', 2000, 15, 20, 40000),
('0525/P/1/0003', 'DMS/01239/', 3000, 15, 30, 90000),
('0525/P/1/0003', 'DMS/01242/', 3000, 15, 48, 144000);

--
-- Trigger `detail_pembelian`
--
DELIMITER $$
CREATE TRIGGER `delete_detail_pembelian` AFTER DELETE ON `detail_pembelian` FOR EACH ROW BEGIN
UPDATE pembelian SET total_bayar = total_bayar - old.subtotal WHERE no_nota = old.no_nota;
UPDATE barang SET stok = stok - old.jumlah_beli WHERE kd_barang = old.kd_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `detail_pembelian` AFTER INSERT ON `detail_pembelian` FOR EACH ROW BEGIN
UPDATE pembelian SET total_bayar = total_bayar + new.subtotal WHERE no_nota = new.no_nota;
UPDATE barang SET harga_jual = (new.harga_beli * (new.margin_jual / 100)) + new.harga_beli, 
stok = stok + new.jumlah_beli WHERE kd_barang = new.kd_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_detail_pembelian` AFTER UPDATE ON `detail_pembelian` FOR EACH ROW BEGIN
UPDATE pembelian SET total_bayar = (total_bayar + new.subtotal) - old.subtotal WHERE no_nota = new.no_nota;
UPDATE barang SET harga_jual = (new.harga_beli * (new.margin_jual / 100)) + new.harga_beli, 
stok = (stok + new.jumlah_beli) - stok WHERE kd_barang = new.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id_pemesanan` int(11) DEFAULT NULL,
  `kd_barang` varchar(10) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT 0,
  `jumlah_jual` int(11) DEFAULT 0,
  `subtotal` int(11) DEFAULT 0,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `no_struk` int(11) DEFAULT NULL,
  `kd_barang` varchar(10) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT 0,
  `jumlah_jual` int(11) DEFAULT 0,
  `subtotal` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`no_struk`, `kd_barang`, `harga_jual`, `jumlah_jual`, `subtotal`) VALUES
(1, 'DMS/01234/', 130000, 2, 260000),
(1, 'PT/0925/01', 13000, 3, 39000),
(2, 'SM/0925/01', 12000, 5, 60000),
(2, 'DMS/01235/', 15000, 1, 15000),
(3, 'PT/0925/01', 13000, 4, 52000),
(1, 'PT/0925/01', 13000, 2, 26000),
(1, 'DMS/01234/', 5200, 2, 10400),
(2, 'DMS/01235/', 31250, 1, 31250),
(2, 'DMS/01236/', 7500, 5, 37500),
(2, 'DMS/01237/', 3200, 6, 19200),
(2, 'DMS/01238/', 16200, 2, 32400),
(3, 'DMS/01239/', 16800, 3, 50400),
(3, 'DMS/01242/', 16200, 3, 48600);

--
-- Trigger `detail_penjualan`
--
DELIMITER $$
CREATE TRIGGER `delete_detail_penjualan` AFTER DELETE ON `detail_penjualan` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok + old.jumlah_jual WHERE kd_barang = old.kd_barang;
UPDATE penjualan SET total_bayar = IFNULL(total_bayar, 0) - old.subtotal WHERE no_struk = old.no_struk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_detail_penjualan` AFTER INSERT ON `detail_penjualan` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok - new.jumlah_jual WHERE kd_barang = new.kd_barang;
UPDATE penjualan SET total_bayar = IFNULL(total_bayar, 0) + new.subtotal WHERE no_struk = new.no_struk;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_detail_penjualan` AFTER UPDATE ON `detail_penjualan` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok + (old.jumlah_jual - new.jumlah_jual) WHERE kd_barang = new.kd_barang;
UPDATE penjualan SET total_bayar = (IFNULL(total_bayar, 0) - old.subtotal) + new.subtotal WHERE no_struk = new.no_struk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `distributor`
--

CREATE TABLE `distributor` (
  `id_distributor` int(11) NOT NULL,
  `nama_distributor` varchar(50) NOT NULL,
  `alamat_distributor` varchar(255) NOT NULL,
  `no_telepon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `distributor`
--

INSERT INTO `distributor` (`id_distributor`, `nama_distributor`, `alamat_distributor`, `no_telepon`) VALUES
(1, 'PT. CAHAYA UTAMA', 'Jln Karadenan No 20 Cibinong Kab. Bogor Jawa Barat', '081384275241'),
(2, 'PT. ANUGRAH INSANI', 'Jln Jakarta-Bogor KM 44 No 120 Cibinong Kab. Bogor Jawa Barat', '081384275768'),
(3, 'PT. INSAN CEMERLANG', 'Pasar Kebon Kembang Blok E No 11 Bogor Jawa Barat', '081384275555'),
(4, 'CV. INDUSTRI BERSAMA', 'Jln H. Juanda No 25 Bogor Jawa Barat', '081384277733'),
(5, 'CV. SUBUR MAKMUR', 'Jln Roda No 2 Bogor Jawa Barat', '081384277790');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(11) NOT NULL,
  `nama_kurir` varchar(50) NOT NULL,
  `alamat_kurir` varchar(255) NOT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `foto_kurir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat_pelanggan` varchar(255) NOT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_pelanggan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `no_nota` varchar(15) NOT NULL,
  `tgl_nota` date NOT NULL,
  `id_distributor` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`no_nota`, `tgl_nota`, `id_distributor`, `total_bayar`) VALUES
('0525/P/1/0001', '2025-05-12', 1, 200000),
('0525/P/1/0002', '2025-05-14', 5, 390000),
('0525/P/1/0003', '2025-05-20', 3, 1362000),
('0925/P/1/0001', '2025-10-12', 3, 1000000),
('1025/P/1/0001', '2025-10-10', 3, 240000),
('1025/P/1/0002', '2025-10-15', 2, 80000),
('2025/P/1/0001', '2025-10-15', 1, 1120000),
('2025/P/1/0002', '2025-10-15', 2, 375000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `tgl_pemesanan` datetime NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `status_pemesanan` enum('draft','dipesan','diproses','dikirim','sampai tujuan','diterima','selesai','dibatalkan pembeli','dibatalkan penjual') DEFAULT 'draft',
  `metode_pembayaran` enum('tf','cod') DEFAULT 'cod',
  `total_bayar` int(11) DEFAULT 0,
  `keterangan_status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_kirim` int(11) NOT NULL,
  `tgl_kirim` datetime NOT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `id_pemesanan` int(11) DEFAULT NULL,
  `bukti_foto` varchar(255) DEFAULT NULL,
  `no_invoice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `no_struk` int(11) NOT NULL,
  `tgl_jual` date NOT NULL,
  `total_bayar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`no_struk`, `tgl_jual`, `total_bayar`) VALUES
(1, '2025-10-15', 335400),
(2, '2025-10-15', 195350),
(3, '2025-10-15', 151000),
(4, '2025-06-02', 36400),
(5, '2025-06-07', 263750),
(6, '2025-06-12', 49800);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('karyawan','pemilik') DEFAULT 'karyawan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vwpembelian`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vwpembelian` (
`no_nota` varchar(15)
,`tgl_nota` date
,`kd_barang` varchar(10)
,`nama_barang` varchar(50)
,`harga_jual` int(11)
,`stok` int(11)
,`nama_distributor` varchar(50)
,`total_bayar` int(11)
,`harga_beli` int(11)
,`margin_jual` smallint(6)
,`jumlah_beli` int(11)
,`subtotal` int(11)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `vwpembelian`
--
DROP TABLE IF EXISTS `vwpembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwpembelian`  AS SELECT `p`.`no_nota` AS `no_nota`, `p`.`tgl_nota` AS `tgl_nota`, `b`.`kd_barang` AS `kd_barang`, `b`.`nama_barang` AS `nama_barang`, `b`.`harga_jual` AS `harga_jual`, `b`.`stok` AS `stok`, `d`.`nama_distributor` AS `nama_distributor`, `p`.`total_bayar` AS `total_bayar`, `dp`.`harga_beli` AS `harga_beli`, `dp`.`margin_jual` AS `margin_jual`, `dp`.`jumlah_beli` AS `jumlah_beli`, `dp`.`subtotal` AS `subtotal` FROM (((`pembelian` `p` join `barang` `b`) join `distributor` `d`) join `detail_pembelian` `dp`) WHERE `p`.`no_nota` = `dp`.`no_nota` AND `p`.`id_distributor` = `d`.`id_distributor` AND `dp`.`kd_barang` = `b`.`kd_barang` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kd_barang`);

--
-- Indeks untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD KEY `no_data` (`no_nota`),
  ADD KEY `kd_barang` (`kd_barang`);

--
-- Indeks untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `kd_barang` (`kd_barang`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD KEY `no_struk` (`no_struk`),
  ADD KEY `kd_barang` (`kd_barang`);

--
-- Indeks untuk tabel `distributor`
--
ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id_distributor`);

--
-- Indeks untuk tabel `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no_nota`),
  ADD KEY `id_distributor` (`id_distributor`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_kirim`),
  ADD KEY `id_kurir` (`id_kurir`),
  ADD KEY `id_pemesanan` (`id_pemesanan`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no_struk`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `distributor`
--
ALTER TABLE `distributor`
  MODIFY `id_distributor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `no_struk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`no_nota`) REFERENCES `pembelian` (`no_nota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pemesanan_ibfk_2` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`no_struk`) REFERENCES `penjualan` (`no_struk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_distributor`) REFERENCES `distributor` (`id_distributor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `pengiriman_ibfk_1` FOREIGN KEY (`id_kurir`) REFERENCES `kurir` (`id_kurir`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengiriman_ibfk_2` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
