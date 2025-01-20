-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jan 2025 pada 04.54
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `edukasi`
--

CREATE TABLE `edukasi` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `edukasi`
--

INSERT INTO `edukasi` (`id`, `title`, `content`, `image`, `created_at`) VALUES
(16, 'q', 'sekali lagi', 'img_678b1cd6c9693_Screenshot (1).png', '2025-01-18 12:15:34'),
(17, 'coba lagi', 'satu asli', 'img_678b1ce7ea44f_Screenshot (4).png', '2025-01-18 12:15:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar`
--

CREATE TABLE `gambar` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gambar`
--

INSERT INTO `gambar` (`id`, `image`, `description`, `created_at`) VALUES
(1, '1736572173_5a46cfd8-fe78-47f1-a702-bdadb3adae84.jpg', 'logo', '2025-01-11 05:09:33'),
(2, 'img_678dbf0d07dd1_Screenshot (11).png', 'deskripsi comtoj', '2025-01-20 12:12:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `manfaat_sampah`
--

CREATE TABLE `manfaat_sampah` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `artikel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `manfaat_sampah`
--

INSERT INTO `manfaat_sampah` (`id`, `gambar`, `artikel`) VALUES
(1, 'uploads/Screenshot (9).png', 'sampah dapat bermanfaat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengolahan_sampah`
--

CREATE TABLE `pengolahan_sampah` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `artikel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengolahan_sampah`
--

INSERT INTO `pengolahan_sampah` (`id`, `gambar`, `artikel`) VALUES
(1, 'uploads/Screenshot (7).png', 'sss');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sampah_bahaya`
--

CREATE TABLE `sampah_bahaya` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sampah_bahaya`
--

INSERT INTO `sampah_bahaya` (`id`, `image`, `deskripsi`) VALUES
(1, NULL, NULL),
(5, 'uploads/5a46cfd8-fe78-47f1-a702-bdadb3adae84.jpg', 'ini logo'),
(6, 'uploads/5a46cfd8-fe78-47f1-a702-bdadb3adae84.jpg', 'ini adalah logo sampah bahaya'),
(7, 'loli.jpg', 'ini kartun\r\n'),
(8, 'Screenshot__2_.png', '1234');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `edukasi`
--
ALTER TABLE `edukasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `manfaat_sampah`
--
ALTER TABLE `manfaat_sampah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengolahan_sampah`
--
ALTER TABLE `pengolahan_sampah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sampah_bahaya`
--
ALTER TABLE `sampah_bahaya`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `edukasi`
--
ALTER TABLE `edukasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `gambar`
--
ALTER TABLE `gambar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `manfaat_sampah`
--
ALTER TABLE `manfaat_sampah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengolahan_sampah`
--
ALTER TABLE `pengolahan_sampah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sampah_bahaya`
--
ALTER TABLE `sampah_bahaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
