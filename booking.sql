-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Agu 2023 pada 03.21
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking_cek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `abouts`
--

INSERT INTO `abouts` (`id`, `nama`, `alamat`, `nomor_hp`, `deskripsi`, `lokasi`, `foto`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Booking', 'Blora', '081222', '<p>Tes</p>', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d790.9925815581432!2d111.41942851193028!3d-6.960892923318576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7741c3267edb83%3A0x8ceb71b6a1df8857!2sBook.ing%20Library%20%26%20Cafe!5e1!3m2!1sid!2sid!4v1689025724467!5m2!1sid!2sid', 'J77CuhMnpJ1BA7pyt07eFDi3eGP1xCStluAatACQ.png', '2023-06-09 20:53:31', '2023-07-10 14:52:17', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `agendas`
--

CREATE TABLE `agendas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `narasumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `agendas`
--

INSERT INTO `agendas` (`id`, `judul`, `jam`, `tanggal`, `deskripsi`, `narasumber`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Coba Resensi', '22:07', '2023-07-01', '<p>Tes</p>', 'Retno Vega Astuti', '2023-06-30 08:07:13', '2023-06-30 08:07:13', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikels`
--

CREATE TABLE `artikels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cafes`
--

CREATE TABLE `cafes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `pelanggan`, `no_hp`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Menda Finanto', '085229740921', 'mendafinanto@gmail.com', '2023-06-25 18:12:13', '2023-06-25 18:12:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailtransaksis`
--

CREATE TABLE `detailtransaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idreservasi` int(11) NOT NULL,
  `idmeja` int(11) NOT NULL,
  `idmenu` int(11) NOT NULL,
  `harga_awal` int(11) NOT NULL,
  `diskon` double(8,2) NOT NULL,
  `harga_akhir` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `detailtransaksis`
--

INSERT INTO `detailtransaksis` (`id`, `idtransaksi`, `idreservasi`, `idmeja`, `idmenu`, `harga_awal`, `diskon`, `harga_akhir`, `jumlah`, `total_harga`, `status`, `aksi`, `created_at`, `updated_at`) VALUES
(1, 3, 9, 0, 3, 10000, 10.00, 9000, 3, 27000, 'aktif', 'diproses', '2023-06-26 16:09:40', '2023-06-30 22:54:42'),
(2, 3, 9, 0, 2, 10000, 8.30, 9170, 2, 18340, 'aktif', 'diproses', '2023-06-26 16:12:35', '2023-06-30 22:54:42'),
(3, 3, 9, 0, 1, 10000, 0.00, 10000, 1, 10000, 'aktif', 'diproses', '2023-06-26 16:12:39', '2023-06-30 22:54:42'),
(4, 1, 0, 1, 3, 10000, 10.00, 9000, 4, 36000, 'aktif', 'diproses', '2023-06-30 01:33:29', '2023-06-30 23:17:09'),
(5, 1, 0, 1, 2, 10000, 8.30, 9170, 1, 9170, 'aktif', 'diproses', '2023-06-30 01:35:04', '2023-06-30 23:17:09'),
(6, 7, 0, 1, 3, 10000, 10.00, 9000, 1, 9000, 'aktif', 'selesai', '2023-06-30 20:58:19', '2023-06-30 22:49:38'),
(7, 7, 0, 1, 2, 10000, 8.30, 9170, 1, 9170, 'aktif', 'selesai', '2023-06-30 20:58:23', '2023-06-30 22:49:38'),
(8, 7, 0, 1, 1, 10000, 0.00, 10000, 1, 10000, 'aktif', 'selesai', '2023-06-30 21:15:34', '2023-06-30 22:49:38'),
(9, 10, 0, 1, 2, 10000, 8.30, 9170, 6, 55020, 'aktif', 'diproses', '2023-06-30 23:15:02', '2023-07-05 09:56:04'),
(15, 10, 0, 1, 3, 10000, 10.00, 9000, 3, 27000, 'aktif', 'diproses', '2023-07-04 14:55:24', '2023-07-05 09:56:04'),
(16, 10, 0, 1, 1, 10000, 0.00, 10000, 2, 20000, 'aktif', 'diproses', '2023-07-04 14:56:02', '2023-07-05 09:56:04'),
(17, 11, 19, 0, 3, 10000, 10.00, 9000, 1, 9000, 'aktif', 'selesai', '2023-07-04 15:43:23', '2023-08-06 02:27:29'),
(18, 11, 19, 0, 2, 10000, 8.30, 9170, 1, 9170, 'aktif', 'selesai', '2023-07-04 15:43:28', '2023-08-06 02:27:29'),
(20, 13, 0, 1, 2, 10000, 8.30, 9170, 5, 45850, 'aktif', 'reserved', '2023-07-10 01:20:01', '2023-07-10 08:17:52'),
(22, 13, 0, 1, 1, 10000, 0.00, 10000, 20, 200000, 'aktif', 'reserved', '2023-07-10 01:29:41', '2023-07-10 08:17:52'),
(24, 0, 20, 0, 2, 10000, 8.30, 9170, 1, 9170, 'aktif', 'reserved', '2023-07-10 07:10:17', '2023-07-10 09:31:10'),
(25, 0, 20, 0, 3, 10000, 10.00, 9000, 1, 9000, 'aktif', 'reserved', '2023-07-10 09:29:05', '2023-07-10 09:29:05'),
(26, 0, 21, 0, 3, 10000, 10.00, 9000, 1, 9000, 'aktif', 'reserved', '2023-07-10 16:02:09', '2023-07-10 16:02:09'),
(27, 0, 22, 0, 3, 10000, 10.00, 9000, 1, 9000, 'aktif', 'reserved', '2023-07-19 20:33:49', '2023-07-19 20:33:49'),
(28, 0, 23, 0, 3, 10000, 10.00, 9000, 20, 180000, 'aktif', 'reserved', '2023-07-24 03:31:11', '2023-07-24 03:31:11'),
(29, 0, 23, 0, 2, 10000, 8.30, 9170, 10, 91700, 'aktif', 'reserved', '2023-07-24 03:32:26', '2023-07-24 03:32:26'),
(30, 0, 24, 0, 3, 10000, 10.00, 9000, 1, 9000, 'aktif', 'reserved', '2023-08-05 21:38:18', '2023-08-05 21:38:18'),
(31, 14, 25, 0, 3, 10000, 10.00, 9000, 20, 180000, 'aktif', 'selesai', '2023-08-05 21:39:30', '2023-08-07 03:22:19'),
(32, 14, 25, 0, 1, 10000, 0.00, 10000, 10, 100000, 'aktif', 'selesai', '2023-08-05 21:39:36', '2023-08-07 03:22:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwals`
--

CREATE TABLE `jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kajians`
--

CREATE TABLE `kajians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `narasumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kajians`
--

INSERT INTO `kajians` (`id`, `judul`, `jam`, `tanggal`, `deskripsi`, `narasumber`, `upload`, `created_at`, `updated_at`, `status`) VALUES
(4, 'Kajian 1', '22:01', '2023-07-10', '<p>Test</p>', 'Retno Vega Astuti', 'vMkHHATkQHZWHrCZhhPSnZ2t8vNDnyhOrlTkmuoh.pdf', '2023-07-10 08:01:34', '2023-07-10 08:01:34', 'aktif'),
(5, 'Coba Resensi', '22:01', '2023-07-10', '<p>tes</p>', 'Vega', '-', '2023-07-10 08:02:00', '2023-07-10 08:02:00', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keperluans`
--

CREATE TABLE `keperluans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keperluan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biaya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `keperluans`
--

INSERT INTO `keperluans` (`id`, `keperluan`, `biaya`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lainnya', '0', 'aktif', '2023-07-25 14:05:20', '2023-07-25 14:06:41'),
(2, 'Sewa', '50000', 'aktif', '2023-08-05 21:32:57', '2023-08-05 21:32:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapakkategoris`
--

CREATE TABLE `lapakkategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lapakkategoris`
--

INSERT INTO `lapakkategoris` (`id`, `kategori`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Buku', 'aktif', '2023-06-05 13:56:26', '2023-06-05 13:56:26'),
(2, 'E-Book', 'aktif', '2023-06-13 19:10:20', '2023-06-13 19:10:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapaks`
--

CREATE TABLE `lapaks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `diskon` double(8,2) NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lapaks`
--

INSERT INTO `lapaks` (`id`, `category`, `name`, `foto`, `harga`, `diskon`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Contoh', 'MNu5XzOiVdxfbtBAsFtTcYeBwDUA2xbHxiKuuZTT.jpg', 10000, 2.50, '<p>Penulis</p>', 'aktif', '2023-06-05 14:05:00', '2023-06-05 14:05:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menukategoris`
--

CREATE TABLE `menukategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menukategoris`
--

INSERT INTO `menukategoris` (`id`, `foto`, `kategori_link`, `kategori`, `status`, `created_at`, `updated_at`) VALUES
(0, 'K5WyjpiqMuT5hTg52wn5bOibtYjRChzyfZRTbryS.png', 'perpustakaan', 'Perpustakaan', 'aktif', '2023-07-24 14:40:12', '2023-07-24 14:40:12'),
(1, 'glEIPNtS4j9UrnykZYBWLFmkecY4QDciqdu3iaxN.jpg', 'makanan', 'Makanan', 'aktif', '2023-06-16 07:21:06', '2023-06-16 07:22:45'),
(2, 'yO9F9HuufWJZJ7jAKCtFh5zDhlvu7iNBDXWOrc06.png', 'minuman', 'Minuman', 'aktif', '2023-06-16 07:21:20', '2023-06-16 07:22:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `diskon` double(8,2) NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `category`, `name`, `foto`, `harga`, `diskon`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Nasi Goreng', 'mui1jbWWcT8WbtgwBNnYrNnTsMjTJuSou1q8Utc0.jpg', 10000, 0.00, '<p>tes</p>', 'aktif', '2023-06-05 13:48:13', '2023-06-05 13:48:13'),
(2, '1', 'Nasi Goreng 2', 'gt2B6TMdNCjqPcznLQwDS1ETRFCKbl79K2vQA9j2.jpg', 10000, 8.30, '<blockquote>\r\n<p>coba</p>\r\n</blockquote>', 'aktif', '2023-06-05 13:51:14', '2023-06-05 13:53:43'),
(3, '2', 'Kopi Hitam', 'PqTCbtKjkawqmCbfyekusz063MlJ0oVdzmW4oXzi.jpg', 10000, 10.00, '<p>Kopi Hitam</p>', 'aktif', '2023-06-16 07:24:36', '2023-06-16 07:24:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2023_02_08_030105_create_cafes_table', 2),
(7, '2023_02_08_065257_create_menu_kategoris_table', 3),
(13, '2023_02_17_034832_create_kategorilapaks_table', 3),
(14, '2023_02_17_034846_create_kategorimenus_table', 3),
(73, '2014_10_12_000000_create_users_table', 4),
(74, '2014_10_12_100000_create_password_resets_table', 4),
(75, '2019_08_19_000000_create_failed_jobs_table', 4),
(76, '2019_12_14_000001_create_personal_access_tokens_table', 4),
(77, '2023_02_08_065105_create_menus_table', 4),
(78, '2023_02_17_033718_create_reservasis_table', 4),
(79, '2023_02_17_034136_create_agendas_table', 4),
(80, '2023_02_17_034623_create_abouts_table', 4),
(81, '2023_02_17_034658_create_artikels_table', 4),
(82, '2023_02_17_034731_create_kajians_table', 4),
(83, '2023_02_17_035111_create_puisis_table', 4),
(84, '2023_02_17_035126_create_resensis_table', 4),
(85, '2023_02_17_035143_create_tims_table', 4),
(86, '2023_02_19_094403_create_menukategoris_table', 4),
(87, '2023_02_19_094423_create_lapakkategoris_table', 4),
(88, '2023_02_19_094528_create_lapaks_table', 4),
(89, '2023_03_04_011320_create_sliders_table', 4),
(90, '2023_06_02_062415_create_qrmejas_table', 4),
(91, '2023_06_21_220224_create_pesanans_table', 5),
(92, '2023_06_22_224103_create_transaksis_table', 6),
(93, '2023_06_22_224337_create_detailtransaksis_table', 6),
(94, '2023_06_22_224357_create_customers_table', 6),
(95, '2023_06_24_031328_create_kategorimonologs_table', 6),
(96, '2023_06_24_031344_create_monologs_table', 6),
(97, '2023_06_26_024055_create_monolog_kategoris_table', 7),
(98, '2023_06_26_024055_create_monologkategoris_table', 8),
(99, '2023_06_26_051406_create_monologkategoris_table', 9),
(100, '2023_07_01_031055_create_jadwals_table', 9),
(101, '2023_07_25_204500_create_keperluans_table', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `monologkategoris`
--

CREATE TABLE `monologkategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `monologkategoris`
--

INSERT INTO `monologkategoris` (`id`, `kategori`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fiksi (novel)', 'aktif', '2023-06-25 19:44:44', '2023-06-25 19:44:44'),
(2, 'Non fiksi  (sejarah, ilmiah, islamiyah)', 'aktif', '2023-06-25 19:45:02', '2023-06-25 19:45:02'),
(3, 'Komik', 'aktif', '2023-06-25 19:45:17', '2023-06-25 19:45:17'),
(4, 'Anak-anak', 'aktif', '2023-06-25 19:45:29', '2023-06-25 19:45:29'),
(5, 'Self-help (psycology, tips\")', 'aktif', '2023-06-25 19:45:42', '2023-06-25 19:45:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `monologs`
--

CREATE TABLE `monologs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` int(11) NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `monologs`
--

INSERT INTO `monologs` (`id`, `category`, `foto`, `judul`, `tanggal`, `deskripsi`, `upload`, `penulis`, `status`, `created_at`, `updated_at`) VALUES
(2, 4, 'FuGIYOGRuyGzbTVeVPeG1VOSSu76w7HBsP18P3d0.jpg', 'Coba Resensi', '2023-06-26', '<p>Test</p>', 'mcyuRrao5zBJP2fZJBAjwbrx3alsY2Af0el6QC2R.pdf', 'Retno Vega Astuti', 'aktif', '2023-06-25 22:06:17', '2023-07-07 04:34:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanans`
--

CREATE TABLE `pesanans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idreservasi` int(11) NOT NULL,
  `idmeja` int(11) NOT NULL,
  `idmenu` int(11) NOT NULL,
  `harga_awal` int(11) NOT NULL,
  `diskon` double(8,2) NOT NULL,
  `harga_akhir` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `qrmejas`
--

CREATE TABLE `qrmejas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_meja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kodeqr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `qrmejas`
--

INSERT INTO `qrmejas` (`id`, `nama_meja`, `kode`, `kodeqr`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Meja 1', '01', 'c4ca4238a0b923820dcc509a6f75849b', 'aktif', '2023-06-06 05:11:49', '2023-07-04 21:07:55'),
(3, 'Meja 2', '02', '-', 'aktif', '2023-08-09 00:45:48', '2023-08-09 00:45:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasis`
--

CREATE TABLE `reservasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idcustomer` bigint(20) NOT NULL,
  `kodereservasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_meja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `massage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buktibayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemilik` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlahbayar` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biayalain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keperluanid` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reservasis`
--

INSERT INTO `reservasis` (`id`, `idcustomer`, `kodereservasi`, `tanggal`, `jam`, `jumlah`, `status`, `no_meja`, `massage`, `pembayaran`, `buktibayar`, `bank`, `pemilik`, `jumlahbayar`, `biayalain`, `keperluanid`, `created_at`, `updated_at`) VALUES
(4, 1, '-', '2023-06-14', '00:00', '0', 'selesai', '0', '', '', '', '', '', '', '', 0, '2023-06-13 18:18:57', '2023-06-30 22:53:32'),
(7, 1, '-', '2023-06-15', '00:00', '0', 'setuju', '0', '', '', '', '', '', '', '', 0, '2023-06-13 19:03:02', '2023-07-02 21:56:09'),
(8, 1, '-', '2023-06-16', '00:00', '0', 'reserved', '0', '', '', '', '', '', '', '', 0, '2023-06-14 00:03:07', '2023-06-14 00:03:07'),
(9, 1, '-', '2023-06-26', '00:00', '0', 'setuju', '1', '', '', '', '', '', '', '50000', 0, '2023-06-19 08:56:59', '2023-07-05 09:50:16'),
(14, 1, '-', '2023-06-27', '00:00', '0', 'reserved', '0', '', '', '', '', '', '', '', 0, '2023-06-25 18:15:36', '2023-06-25 18:15:36'),
(15, 1, '-', '2023-06-30', '00:00', '0', 'ditolak', '0', '', '', '', '', '', '', '', 0, '2023-06-30 01:37:01', '2023-06-30 20:06:54'),
(16, 1, '-', '2023-07-02', '00:00', '0', 'reserved', '0', '', '', '', '', '', '', '', 0, '2023-06-30 21:19:31', '2023-06-30 21:19:31'),
(17, 1, '-', '2023-07-01', '00:00', '0', 'reserved', '0', '', '', '', '', '', '', '', 0, '2023-06-30 22:45:28', '2023-06-30 22:45:28'),
(19, 1, 'r20230704104223', '2023-07-05', '06:40', '20', 'selesai', '1', 'Contoh', '-', '-', '', '', '', '10000', 0, '2023-07-04 15:42:23', '2023-07-05 09:54:44'),
(20, 1, 'R20230710084120', '2023-07-10', '15:41', '20', 'reserved', '0', 'coba', 'QRIS', '-', '', '', '', '10000', 0, '2023-07-10 01:41:20', '2023-07-10 09:56:05'),
(21, 1, 'R20230710110157', '2023-07-11', '06:01', '20', 'setuju', '1', 'Cek', 'QRIS', 'dtnOcpvQlViK3mw4Jl0fwOzVk1mWiRAB69oTdBI6.jpg', '', '', '', '10000', 0, '2023-07-10 16:01:57', '2023-07-10 17:49:24'),
(22, 1, 'R20230720033342', '2023-07-20', '10:33', '20', 'reserved', '0', 'cel', 'QRIS', '-', '', '', '', '0', 0, '2023-07-19 20:33:42', '2023-07-19 20:34:00'),
(23, 1, 'R20230724102646', '2023-07-24', '17:25', '20', 'reserved', '0', 'Pesan', 'QRIS', '-', '', '', '', '0', 0, '2023-07-24 03:26:46', '2023-07-24 03:32:45'),
(25, 1, 'R20230806043921', '2023-08-06', '11:37', '20', 'selesai', '1', 'con', 'QRIS', '114000321', 'Bank Jateng', 'MENDA FINANTO', '10', '50000', 2, '2023-08-05 21:39:21', '2023-08-07 03:20:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sliders`
--

INSERT INTO `sliders` (`id`, `judul`, `foto`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Coba Slider', 'DYkDi7ZoKSyZ3WmaUpIkua28ClUQC2D6CaqfgdyY.jpg', '<p>Contoh Slider</p>', 'aktif', '2023-06-09 20:38:32', '2023-06-09 20:38:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tims`
--

CREATE TABLE `tims` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tims`
--

INSERT INTO `tims` (`id`, `nama`, `posisi`, `foto`, `created_at`, `updated_at`, `status`) VALUES
(1, 'MENDA FINANTO', 'Koki', 'QqBiYu9okgbvgk3oBQTE6t4peYqSeR5nBdmsgChS.png', '2023-06-10 06:45:31', '2023-06-10 06:45:31', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idreservasi` int(11) NOT NULL,
  `idmeja` int(11) NOT NULL,
  `kodetransaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksis`
--

INSERT INTO `transaksis` (`id`, `idreservasi`, `idmeja`, `kodetransaksi`, `customer`, `status`, `aksi`, `created_at`, `updated_at`) VALUES
(1, 0, 1, '987654345678', 'Menda', 'aktif', 'diproses', '2023-06-30 13:32:09', '2023-06-30 23:17:09'),
(3, 9, 1, '20230630115102', 'Menda Finanto', 'aktif', 'diproses', '2023-06-30 16:51:02', '2023-06-30 22:54:42'),
(6, 0, 1, '20230701044418', 'Menda Finanto', 'aktif', 'diproses', '2023-06-30 21:44:18', '2023-07-05 09:55:23'),
(7, 0, 1, '20230701045337', 'Menda Finanto', 'aktif', 'selesai', '2023-06-30 21:53:37', '2023-06-30 22:49:38'),
(8, 4, 1, '20230701055332', 'Menda Finanto', 'aktif', 'diproses', '2023-06-30 22:53:32', '2023-06-30 22:54:17'),
(9, 0, 1, '20230705061529', 'vega', 'aktif', 'diproses', '2023-06-30 23:15:29', '2023-07-05 09:55:40'),
(10, 0, 1, '20230704095915', 'Menda Finanto', 'aktif', 'diproses', '2023-07-04 14:59:15', '2023-07-05 09:56:04'),
(11, 19, 1, '20230705045444', 'Menda Finanto', 'aktif', 'selesai', '2023-07-05 09:54:44', '2023-08-06 02:27:29'),
(12, 0, 1, '20230707112524', 'Vega', 'aktif', 'diproses', '2023-07-07 04:25:24', '2023-08-07 02:26:21'),
(13, 0, 1, '20230710031752', 'Menda Finanto', 'aktif', 'reserved', '2023-07-10 08:17:52', '2023-07-10 08:17:52'),
(14, 25, 1, '20230807102047', 'Menda Finanto', 'aktif', 'selesai', '2023-08-07 03:20:47', '2023-08-07 03:22:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Menda Finanto', 'mendafinanto@gmail.com', NULL, '$2y$10$pUBvtoZnmCPcv7FZJS9eC.rpjR.8ORnOEHxZGz0qrFMH18iZT8PHi', 'bWSU4Q5WHl0Nk2NnNbq2YHMTos9PNBrU6TKDEfWCrab5ZtRse4VYMZwmOatZ', '2023-06-05 06:20:43', '2023-06-05 06:20:43'),
(4, 'Booking', 'booking@gmail.com', NULL, '$2y$10$ogiERXsfZN2pXf9XladwDeu2NoxpAbX6Q4JVMJ7VxIQWdoey4a9wW', NULL, '2023-08-09 01:05:17', '2023-08-09 01:25:14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `artikels`
--
ALTER TABLE `artikels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cafes`
--
ALTER TABLE `cafes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detailtransaksis`
--
ALTER TABLE `detailtransaksis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kajians`
--
ALTER TABLE `kajians`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keperluans`
--
ALTER TABLE `keperluans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lapakkategoris`
--
ALTER TABLE `lapakkategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lapaks`
--
ALTER TABLE `lapaks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menukategoris`
--
ALTER TABLE `menukategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `monologkategoris`
--
ALTER TABLE `monologkategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `monologs`
--
ALTER TABLE `monologs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `qrmejas`
--
ALTER TABLE `qrmejas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reservasis`
--
ALTER TABLE `reservasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tims`
--
ALTER TABLE `tims`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `artikels`
--
ALTER TABLE `artikels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `cafes`
--
ALTER TABLE `cafes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detailtransaksis`
--
ALTER TABLE `detailtransaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kajians`
--
ALTER TABLE `kajians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `keperluans`
--
ALTER TABLE `keperluans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `lapakkategoris`
--
ALTER TABLE `lapakkategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `lapaks`
--
ALTER TABLE `lapaks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `menukategoris`
--
ALTER TABLE `menukategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `monologkategoris`
--
ALTER TABLE `monologkategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `monologs`
--
ALTER TABLE `monologs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanans`
--
ALTER TABLE `pesanans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `qrmejas`
--
ALTER TABLE `qrmejas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `reservasis`
--
ALTER TABLE `reservasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tims`
--
ALTER TABLE `tims`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
