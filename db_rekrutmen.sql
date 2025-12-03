-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Des 2025 pada 01.20
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
-- Database: `db_rekrutmen`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang_pekerjaan`
--

CREATE TABLE `bidang_pekerjaan` (
  `id` bigint(20) NOT NULL,
  `bidang_pekerjaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bidang_pekerjaan`
--

INSERT INTO `bidang_pekerjaan` (`id`, `bidang_pekerjaan`) VALUES
(2, 'Barista'),
(3, 'Staff Kitchen'),
(4, 'Waiters'),
(5, 'Checker');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `id` int(11) NOT NULL,
  `pelamar_id` bigint(20) DEFAULT NULL,
  `pertanyaan_id` bigint(20) DEFAULT NULL,
  `rekrutmen_id` int(11) DEFAULT NULL,
  `jawaban` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lampiran`
--

CREATE TABLE `lampiran` (
  `id` int(11) NOT NULL,
  `pelamar_id` bigint(20) DEFAULT NULL,
  `rekrutmen_id` int(11) DEFAULT NULL,
  `lampiran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan_kerja`
--

CREATE TABLE `lowongan_kerja` (
  `id` bigint(20) NOT NULL,
  `bidang_pekerjaan_id` bigint(20) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal_buka` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `persyaratan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lowongan_kerja`
--

INSERT INTO `lowongan_kerja` (`id`, `bidang_pekerjaan_id`, `judul`, `tanggal_buka`, `tanggal_berakhir`, `salary`, `deskripsi`, `persyaratan`) VALUES
(1, 2, 'Barista Full-Time', '2025-11-27', '2025-12-31', 2700000.00, 'Kami mencari Barista yang ramah, cekatan, dan memiliki minat kuat dalam dunia kopi untuk bergabung dengan tim kami. ', 'KTP, Kartu Keluarga, Parklaring'),
(3, 3, 'Staff Dapur', '2025-10-02', '2025-12-31', 3250000.00, 'Kami mencari Staff Kitchen yang bertanggung jawab, disiplin, dan mampu bekerja dalam tim untuk bergabung di dapur kami. ', 'KTP, Kartu Keluarga, Ijazah Terakhir, SKCK & Parklaring'),
(4, 4, 'Waiter / Waitress', '2025-12-01', '2025-12-31', 2000000.00, 'Kami sedang mencari Waiter/Waitress yang ramah, cepat, dan memiliki semangat pelayanan tinggi untuk bergabung bersama tim kami.', 'KTP, Kartu Keluarga, Ijazah Terakhir'),
(5, 5, 'Lowongan Pekerjaan - Checker', '2025-10-03', '2025-12-31', 2800000.00, 'Kami mencari Checker yang teliti, disiplin, dan bertanggung jawab untuk memastikan seluruh proses pengecekan barang berjalan dengan akurat', 'KTP, Kartu Keluarga, Ijazah Terakhir & SKCK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) DEFAULT NULL,
  `role` enum('admin','pelamar') NOT NULL DEFAULT 'pelamar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `username`, `password`, `nomor_telepon`, `role`) VALUES
(1, 'Ahmad Muhtami', 'admin', '21232f297a57a5a743894a0e4a801fc3', '089352377583', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` bigint(20) NOT NULL,
  `lowongan_id` bigint(20) DEFAULT NULL,
  `pertanyaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `lowongan_id`, `pertanyaan`) VALUES
(7, 1, 'Apa motivasi anda melamar pekerjaan?'),
(8, 1, 'Berapa salary yang anda tawarkan?'),
(9, 1, 'Jelaskan perbedaan antara arabika dan robusta!'),
(10, 1, 'Apa yang dimaksud dengan espresso extraction dan berapa waktu ideal ekstraksi espresso?'),
(11, 1, 'Sebutkan tiga faktor yang mempengaruhi rasa espresso!'),
(12, 1, 'Bagaimana langkah Anda membuat latte art sederhana, misalnya heart?'),
(13, 1, 'Jika ada antrean panjang dan mesin espresso tiba-tiba melambat, apa yang akan Anda lakukan?'),
(14, 1, 'Bagaimana cara yang benar untuk steaming milk agar menghasilkan microfoam halus?'),
(15, 1, 'Apa perbedaan manual brew pour-over (misal V60) dengan espresso?'),
(16, 1, 'Mengapa kebersihan peralatan sangat penting dalam pekerjaan barista?'),
(17, 3, 'Ceritakan pengalaman Anda bekerja di kitchen sebelumnya. Apa posisi Anda dan apa tugas utama Anda?'),
(18, 3, 'Jelaskan bagaimana Anda menjaga kebersihan dan sanitasi saat bekerja di dapur.'),
(19, 3, 'Apa yang Anda lakukan jika bahan makanan yang diterima kualitasnya tidak sesuai standar?'),
(20, 3, 'Bagaimana cara Anda menyimpan bahan makanan agar tetap segar dan aman digunakan?'),
(21, 3, 'Sebutkan contoh situasi di mana Anda bekerja di bawah tekanan (rush hour). Bagaimana Anda mengatasinya?'),
(22, 3, 'Apa yang Anda lakukan jika terjadi kesalahan pesanan atau ada hidangan yang harus diulang?'),
(23, 3, 'Bagaimana Anda memastikan konsistensi rasa dan tampilan makanan?'),
(24, 3, 'Jika Anda diminta menyiapkan 3 jenis pesanan berbeda dalam waktu bersamaan, bagaimana Anda mengatur prioritas?'),
(25, 3, 'Tes Keterampilan: “Buatkan rencana persiapan kitchen untuk shift pagi (prep list) dalam 5 menit.”'),
(26, 3, 'Tes Praktik: “Potong bawang/ sayuran sesuai standar ukuran (dice, slice, julienne)”'),
(27, 4, 'Ceritakan pengalaman Anda bekerja sebagai waiter/waitress sebelumnya. Apa tugas utama yang paling Anda kuasai?'),
(28, 4, 'Bagaimana Anda menghadapi pelanggan yang komplain atau tidak puas dengan pesanan mereka?'),
(29, 4, 'Jelaskan bagaimana Anda menjaga sikap, bahasa tubuh, dan keramahan saat melayani tamu.'),
(30, 4, 'Bagaimana Anda mengatur prioritas ketika banyak meja meminta bantuan dalam waktu bersamaan?'),
(31, 4, 'Apa yang Anda lakukan jika Anda melakukan kesalahan, misalnya salah mencatat pesanan atau telat mengantar minuman?'),
(32, 4, 'Bagaimana menurut Anda komunikasi yang baik antara waiter dengan barista atau kitchen?'),
(33, 4, 'Jika ada pelanggan yang datang pertama kali ke kedai, bagaimana Anda memberikan rekomendasi menu?'),
(34, 4, 'Apa yang Anda lakukan untuk memastikan area kerja dan meja pelanggan tetap bersih selama jam operasional?'),
(35, 4, 'Ceritakan situasi ketika Anda bekerja pada saat sangat ramai. Bagaimana cara Anda tetap fokus?'),
(36, 4, 'Mengapa Anda ingin bekerja sebagai waiter di tempat kami, dan apa kelebihan Anda dibandingkan kandidat lainnya?'),
(37, 5, 'Bagaimana cara Anda memastikan data stok atau barang yang Anda cek benar-benar akurat? Jelaskan langkah-langkah Anda secara detail.'),
(38, 5, 'Ceritakan pengalaman ketika Anda menemukan selisih stok atau data yang tidak sesuai. Apa yang Anda lakukan dan bagaimana Anda menyelesaikannya?'),
(39, 5, 'Bagaimana cara Anda mengatur prioritas saat harus mengecek banyak item dalam waktu terbatas?'),
(40, 5, 'Menurut Anda, apa faktor utama yang menyebabkan selisih antara stok di sistem dan stok fisik? Bagaimana cara Anda mencegah hal tersebut?'),
(41, 5, 'Apakah Anda pernah menghadapi situasi di mana Anda harus menunjukkan kejujuran meskipun itu merugikan tim atau diri sendiri? Jelaskan.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekrutmen`
--

CREATE TABLE `rekrutmen` (
  `id` int(11) NOT NULL,
  `pelamar_id` bigint(20) DEFAULT NULL,
  `lowongan_id` bigint(20) DEFAULT NULL,
  `no_ktp` varchar(25) NOT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `usia` varchar(25) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `agama` varchar(25) DEFAULT NULL,
  `alamat_domisili` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cv` text DEFAULT NULL,
  `status` enum('menunggu','diproses','diterima','ditolak') DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `tanggal` date DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bidang_pekerjaan`
--
ALTER TABLE `bidang_pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelamar_id` (`pelamar_id`),
  ADD KEY `pertanyaan_id` (`pertanyaan_id`),
  ADD KEY `rekrutmen_id` (`rekrutmen_id`);

--
-- Indeks untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelamar_id` (`pelamar_id`),
  ADD KEY `rekrutmen_id` (`rekrutmen_id`);

--
-- Indeks untuk tabel `lowongan_kerja`
--
ALTER TABLE `lowongan_kerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bidang_pekerjaan_id` (`bidang_pekerjaan_id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lowongan_id` (`lowongan_id`);

--
-- Indeks untuk tabel `rekrutmen`
--
ALTER TABLE `rekrutmen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelamar_id` (`pelamar_id`),
  ADD KEY `fk_lowongan_rekrutmen` (`lowongan_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bidang_pekerjaan`
--
ALTER TABLE `bidang_pekerjaan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `lowongan_kerja`
--
ALTER TABLE `lowongan_kerja`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `rekrutmen`
--
ALTER TABLE `rekrutmen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`pelamar_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_3` FOREIGN KEY (`rekrutmen_id`) REFERENCES `rekrutmen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lampiran`
--
ALTER TABLE `lampiran`
  ADD CONSTRAINT `lampiran_ibfk_1` FOREIGN KEY (`pelamar_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lampiran_ibfk_2` FOREIGN KEY (`rekrutmen_id`) REFERENCES `rekrutmen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lowongan_kerja`
--
ALTER TABLE `lowongan_kerja`
  ADD CONSTRAINT `lowongan_kerja_ibfk_1` FOREIGN KEY (`bidang_pekerjaan_id`) REFERENCES `bidang_pekerjaan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan_kerja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekrutmen`
--
ALTER TABLE `rekrutmen`
  ADD CONSTRAINT `fk_lowongan_rekrutmen` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan_kerja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekrutmen_ibfk_1` FOREIGN KEY (`pelamar_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
