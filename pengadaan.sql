-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Apr 2022 pada 10.46
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengadaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_barang`
--

CREATE TABLE `daftar_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `harga_beli` varchar(50) NOT NULL,
  `harga_jual` varchar(50) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `daftar_barang`
--

INSERT INTO `daftar_barang` (`id`, `nama`, `harga_beli`, `harga_jual`, `satuan`) VALUES
(1, 'Sound System', '500000', '600000', 'Set'),
(2, 'Kamera', '1000000', '2000000', 'Pcs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasa`
--

CREATE TABLE `jasa` (
  `id` int(11) NOT NULL,
  `jasa_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `biaya_budget` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `penanggung_jawab` int(11) NOT NULL,
  `detail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jasa`
--

INSERT INTO `jasa` (`id`, `jasa_id`, `tanggal`, `pelanggan_id`, `biaya_budget`, `status`, `penanggung_jawab`, `detail`) VALUES
(1, 1, '2021-12-13', 6, '50000', 'DISETUJUI & DIPROSES', 3, '<p>yang bersih</p>'),
(2, 1, '2021-12-16', 13, '50000', 'MENUNGGU', 0, '<p>ok</p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(11) NOT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenkel` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status_aktif` varchar(20) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id`, `nik`, `nama`, `jenkel`, `jabatan`, `no_hp`, `alamat`, `status_aktif`, `username`, `password`) VALUES
(1, '6209090', 'Udin1', 'L', 'Pimpinan', '090', 'jl ayani', 'aktif', 'admin', 'admin'),
(3, '99', 'jon', 'L', 'Marketing', '99', '2', 'aktif', 'marketing', 'marketing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `nik` varchar(150) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `hp` varchar(18) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `verifikasi` enum('sudah_verifikasi','waiting','data_tidak_valid') DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `jenkel` enum('Pria','Wanita') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `kode`, `nik`, `nama`, `alamat`, `hp`, `username`, `password`, `verifikasi`, `email`, `tgl_daftar`, `jenkel`) VALUES
(5, 'P0001', '123', 'Riky', 'Jl. Ayani', '123', '123', '123', 'waiting', '123@gmail.com', '2021-09-01', 'Pria'),
(6, 'P0002', 'pelanggan1', 'Dino', 'Jl. Ayani', '0822448533', 'pelanggan', 'pelanggan', 'sudah_verifikasi', '123@gmail.com', '2021-09-01', 'Wanita'),
(7, 'P0003', '4666', 'Hanif', 'Banjarmasin', '0821445575', 'pelanggan', 'pelanggan', 'sudah_verifikasi', '123@gmail.com', '2021-09-01', 'Wanita'),
(8, 'P0004', '4666', 'Udin', 'Palembang', '0822575577', 'pelanggan', 'pelanggan', 'sudah_verifikasi', '123@gmail.com', '2021-09-01', 'Pria'),
(9, 'P0005', '111', 'Adi', 'Jakarta', '0821755671', 'pelanggan', 'pelanggan', 'sudah_verifikasi', '123@gmail.com', '2021-09-01', 'Pria'),
(10, 'P0006', '111', 'Usai', 'Jakarta', '0821755671', 'pelanggan', 'pelanggan', 'sudah_verifikasi', '123@gmail.com', '2021-09-01', 'Pria'),
(11, 'P0007', '111', 'Rizk', 'Jakarta', '0821755671', 'pelanggan', 'pelanggan', 'sudah_verifikasi', '123@gmail.com', '2021-09-01', 'Pria'),
(12, 'P0008', '111', 'Jeff', 'Jakarta', '0821755671', 'pelanggan', 'pelanggan', 'sudah_verifikasi', '123@gmail.com', '2021-09-01', 'Pria'),
(13, 'P0009', '2222', '2222', '2222', '2222', '2222', '2222', 'sudah_verifikasi', '2222@gmail.com', '2021-12-16', 'Pria'),
(14, 'P0010', '12', '123', '123', '123', '123', '123', 'waiting', '1232@gmail.com', '2022-01-04', 'Pria');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelayanan`
--

CREATE TABLE `pelayanan` (
  `id` int(11) NOT NULL,
  `nama_pelayanan` varchar(150) DEFAULT NULL,
  `jenis` enum('jasa','pengadaan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelayanan`
--

INSERT INTO `pelayanan` (`id`, `nama_pelayanan`, `jenis`) VALUES
(1, 'Pemeliharaan Gedung', 'jasa'),
(2, 'Photo & Videografi', 'jasa'),
(3, 'Barang Furniture', 'pengadaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id` int(11) NOT NULL,
  `tgl_pengadaan` date NOT NULL,
  `permintaan_id` int(11) NOT NULL,
  `status` varchar(250) NOT NULL,
  `ket` text DEFAULT NULL,
  `foto` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengadaan`
--

INSERT INTO `pengadaan` (`id`, `tgl_pengadaan`, `permintaan_id`, `status`, `ket`, `foto`) VALUES
(9, '2022-01-12', 1, 'SEDANG DIPROSES', '<p>ok</p>', '84437a783e96e-ca41-406a-9239-bec356758bca.jpg'),
(10, '2022-01-12', 2, 'SELESAI DIPENUHI', '<p>ok</p>', '189762.jpg'),
(11, '2022-01-12', 3, 'SELESAI DIPENUHI', '<p>a</p>', '127718d4ed827-1433-4fe9-b5d3-42202c761998.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int(11) NOT NULL,
  `ttd` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `ttd`) VALUES
(1, 'udin gambut');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan`
--

CREATE TABLE `permintaan` (
  `id` int(11) NOT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `tgl_permintaan` date DEFAULT NULL,
  `jumlah_minta` int(11) DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `total_permintaan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `permintaan`
--

INSERT INTO `permintaan` (`id`, `pelanggan_id`, `barang_id`, `tgl_permintaan`, `jumlah_minta`, `ket`, `total_permintaan`) VALUES
(1, 5, 1, '2022-01-01', 2, 'Merk Simbadda aja', '1200000'),
(2, 13, 1, '2022-01-08', 1, '<p>ok</p>', '600000'),
(3, 6, 2, '2022-01-04', 2, '<p>canon</p>', '4000000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daftar_barang`
--
ALTER TABLE `daftar_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`),
  ADD KEY `penanggung_jawab` (`penanggung_jawab`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelayanan`
--
ALTER TABLE `pelayanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`permintaan_id`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permintaan`
--
ALTER TABLE `permintaan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `daftar_barang`
--
ALTER TABLE `daftar_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pelayanan`
--
ALTER TABLE `pelayanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengadaan`
--
ALTER TABLE `pengadaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `permintaan`
--
ALTER TABLE `permintaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
