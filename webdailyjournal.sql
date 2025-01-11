-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jan 2025 pada 04.09
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdailyjournal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `image`, `created_at`, `username`) VALUES
(2, 'JavaScript Array Iteration Method', 'Explore various array iteration methods in JavaScript, including forEach, map, filter, and reduce. Learn when to use each method to manipulate arrays effectively and improve your coding skills.', 'picture2.png', '2024-12-12 20:22:23', 'admin'),
(3, 'Must-Know Media Queries for Devs!', 'Dive into the world of responsive design with essential media queries that every developer should know. This article will guide you through creating layouts that adapt to various screen sizes effortlessly.', 'picture3.png', '2024-12-12 20:22:23', 'admin'),
(5, 'Difference between em and rem Units', 'Understand the differences between em and rem units in CSS. This article explains their use cases, advantages, and how they affect layout and typography, helping you make informed decisions in your stylesheets.', 'picture5.png', '2024-12-12 20:23:38', 'admin'),
(6, 'Must-Have Chrome Extensions for Devs!', 'Enhance your development experience with these must-have Chrome extensions. From debugging tools to performance analyzers, discover the best extensions that will help you code more efficiently.', 'picture6.png', '2024-12-12 20:24:39', 'admin'),
(7, 'Ways to Search an Item in an Array', 'Learn different techniques for searching items in an array, including linear search and binary search. This article provides examples and performance comparisons to help you choose the right method for your needs.', 'picture7.png', '2024-12-12 20:24:39', 'admin'),
(8, 'Must-Know Git Commands for Devs', 'Familiarize yourself with essential Git commands that every developer should master. This guide covers basic commands for version control and collaboration, helping you streamline your workflow.', 'picture8.png', '2024-12-12 20:25:59', 'admin'),
(10, 'Ini adalah data', 'check', '20250105085505.png', '2025-01-05 08:55:05', 'danny');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `photo` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `photo`, `created_at`) VALUES
(12, 'danny', 'd41d8cd98f00b204e9800998ecf8427e', '20250105085807.png', '2025-01-05 01:58:07');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
