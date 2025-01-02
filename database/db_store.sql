-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2024 at 05:31 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_customer`
--

CREATE TABLE `tabel_customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `alamat_customer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_customer`
--

INSERT INTO `tabel_customer` (`id_customer`, `nama_customer`, `no_tlp`, `alamat_customer`) VALUES
(1, 'Danur faqih', '089743243111', 'jl. ujung harapan no.36 Kabupaten Bekasi'),
(2, 'Imam', '084654765999', 'kota bekasi'),
(5, 'Ilyas', '089888756723', 'Kota Bekasi'),
(17, 'Hanif Luqmanul', '087437484832', 'jalan doang pacaran kaga'),
(18, 'davidra deva', '087456237856', 'jalan doang pacaran kaga eaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kategori`
--

CREATE TABLE `tabel_kategori` (
  `kategori_id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_kategori`
--

INSERT INTO `tabel_kategori` (`kategori_id`, `nama_kategori`) VALUES
(1, 'Paket Akhwat'),
(2, 'Paket Ikhwan'),
(3, 'Paket Hijrah');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_produk`
--

CREATE TABLE `tabel_produk` (
  `produk_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` double NOT NULL,
  `foto_produk` varchar(255) DEFAULT NULL,
  `detail_produk` text DEFAULT NULL,
  `ketersediaan_stok` enum('habis','tersedia') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_produk`
--

INSERT INTO `tabel_produk` (`produk_id`, `kategori_id`, `nama_produk`, `harga_produk`, `foto_produk`, `detail_produk`, `ketersediaan_stok`) VALUES
(1, 2, 'Paket Sholeh 1', 150000, 'laki1.jpg', 'Dapatkan paket alat solat lengkap dengan sarung abu-abu yang elegan, peci hitam yang klasik, tasbih hitam yang indah, Alquran kecil praktis, dan sajadah hitam yang nyaman. Siapkan diri Anda untuk menjalankan ibadah dengan khusyuk dan gaya yang sempurna. Segera miliki paket ini dan nikmati kenyamanan dalam setiap ibadah Anda.', 'tersedia'),
(2, 2, 'Paket Sholeh 2', 150000, 'laki2.jpg', 'Dapatkan paket alat solat eksklusif kami yang berisi sarung hitam yang elegan, baju koko coklat tua yang memancarkan kesederhanaan, dompet hitam yang praktis, parfum dengan aroma yang menyegarkan, sajadah navy yang indah, dan jam tangan hitam yang stylish. Hadirkan keanggunan dan kenyamanan dalam setiap ibadah Anda. Segera miliki paket ini dan buat pengalaman solat Anda menjadi lebih istimewa.', 'tersedia'),
(3, 2, 'Paket Sholeh 3', 150000, 'laki3.png', 'Dapatkan paket alat solat eksklusif kami dengan sarung putih yang memukau dengan motif yang menawan, baju kaos hijau tosca yang nyaman dipakai, peci abu-abu bermotif yang memberi sentuhan klasik, serta sajadah hijau tosca yang memperindah ruang ibadah Anda. Sempurnakan ibadah Anda dengan gaya yang elegan dan nyaman. Segera miliki paket ini untuk pengalaman solat yang lebih berkesan dan berwarna.', 'tersedia'),
(4, 1, 'Paket Sholehah 1', 150000, 'cewe1.jpg', 'Dapatkan paket alat solat istimewa yang berisi kerudung pink yang anggun, Alquran kecil dengan motif pink putih yang manis, mini bucket bunga yang menambah kesegaran ruang ibadah Anda, serta kartu ucapan untuk menyampaikan doa dan harapan. Hadirkan nuansa kelembutan dan keindahan dalam setiap ibadah Anda. Segera miliki paket ini untuk pengalaman solat yang penuh dengan kasih sayang dan keceriaan.', 'tersedia'),
(5, 1, 'Paket Sholehah 2', 150000, 'cewe2.jpg', 'Dapatkan paket alat Sholat yang lengkap dan elegan, terdiri dari mukena putih bermotif yang cantik, Alquran kecil berwarna biru yang praktis, tas mini khusus untuk menyimpan Alquran dengan rapi, tasbih putih yang indah untuk dzikir anda, serta kartu ucapan yang menyentuh hati. Hadirkan keanggunan dan kenyamanan dalam setiap ibadah Anda dengan paket ini. Segera miliki untuk pengalaman solat yang lebih istimewa dan berkesan.', 'tersedia'),
(6, 1, 'Paket Sholehah 3', 150000, 'cewe3.jpg', 'Dapatkan paket alat solat yang istimewa dengan mukena coklat yang anggun, Alquran kecil berwarna coklat yang praktis, tas eksklusif khusus untuk mukena coklat, sajadah putih bermotif yang menawan, tasbih putih yang indah untuk mendampingi ibadah Anda, serta kerudung coklat yang memberikan kesan elegan. Sempurnakan ibadah Anda dengan gaya dan kenyamanan yang tak tertandingi. Segera miliki paket ini untuk pengalaman solat yang lebih berkesan dan bermakna.', 'tersedia'),
(7, 3, 'Paket Hijrah 1', 150000, 'hijrah1.jpg', 'Dapatkan paket alat solat yang unik dan elegan, termasuk mukena hijau tosca yang memukau, baju koko abu-abu yang memberikan kesan sederhana namun anggun, sarung hitam motif garis yang menambah sentuhan modern, serta dua sajadah hitam bermotif yang memperindah ruang ibadah Anda. Sempurnakan ibadah Anda dengan gaya yang berkelas dan nyaman. Segera miliki paket ini untuk pengalaman solat yang lebih istimewa dan berwarna.', 'tersedia'),
(8, 3, 'Paket Hijrah 2', 150000, 'hijrah2.jpg', 'Dapatkan paket alat solat yang lengkap dan menawan dengan mukena coklat yang disertai tasnya, sarung hitam motif garis coklat, serta peci putih yang klasik. Nikmati kesempurnaan ibadah Anda dengan sajadah coklat yang dilengkapi dengan tasbih putih, dan sajadah merah yang menyertakan tasbih hitam. Hadirkan sentuhan keindahan dengan mukena pink yang diperindah dengan brossnya. Tidak hanya itu, paket ini juga mencakup 2 Alquran berwarna hitam dan coklat untuk memperdalam spiritualitas Anda. Segera miliki paket ini untuk pengalaman solat yang lebih berkesan dan beragam.', 'tersedia'),
(9, 3, 'Paket Hijrah 3', 150000, 'hijrah3.jpg', 'Dapatkan paket alat solat eksklusif untuk pria dan wanita yang menghadirkan kelebihan bagi kedua jenis kelamin. Box pria berisi sarung hitam bermotif yang elegan, sajadah hitam yang praktis, tasbih hitam yang indah, dan kartu ucapan yang penuh makna. Sementara itu, box wanita menampilkan mukena abu-abu yang cantik dengan tasnya yang sesuai, sajadah hijau tosca yang menawan, tasbih hitam yang elegan, buku \"70 Kekeliruan Wanita\" yang memberikan wawasan, serta kartu ucapan yang menyentuh hati. Sempurnakan ibadah Anda dengan paket ini yang dirancang khusus untuk memenuhi kebutuhan dan gaya hidup Anda. Segera miliki untuk pengalaman solat yang lebih bermakna dan berkesan.', 'tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_transaksi`
--

CREATE TABLE `tabel_transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_tgl` date NOT NULL,
  `produk` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `harga_transaksi` int(11) NOT NULL,
  `jumlah_transaksi` int(100) NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `transaksi_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_transaksi`
--

INSERT INTO `tabel_transaksi` (`transaksi_id`, `transaksi_tgl`, `produk`, `nama_pelanggan`, `harga_transaksi`, `jumlah_transaksi`, `total_transaksi`, `transaksi_status`) VALUES
(5, '2024-01-26', '3', '1', 2, 5, 750000, '0'),
(6, '2024-01-26', '33', '5', 33, 3, 3000000, '0'),
(8, '2024-01-11', 'Paket Sholeh 1', 'Ilyas', 1, 5, 750000, '0'),
(15, '2024-01-10', '7', '2', 3, 2, 300000, '0'),
(16, '2024-01-15', '7', '5', 7, 3, 450000, '0'),
(18, '2024-01-12', '5', '18', 1, 1, 150000, '0'),
(19, '2024-01-20', '9', '17', 1, 1, 150000, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(3, 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(4, 'user', '6ad14ba9986e3615423dfca256d04e3f', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_customer`
--
ALTER TABLE `tabel_customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `tabel_kategori`
--
ALTER TABLE `tabel_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `tabel_produk`
--
ALTER TABLE `tabel_produk`
  ADD PRIMARY KEY (`produk_id`),
  ADD KEY `nama_produk` (`nama_produk`),
  ADD KEY `kategori_produk` (`kategori_id`);

--
-- Indexes for table `tabel_transaksi`
--
ALTER TABLE `tabel_transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_customer`
--
ALTER TABLE `tabel_customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tabel_kategori`
--
ALTER TABLE `tabel_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tabel_produk`
--
ALTER TABLE `tabel_produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tabel_transaksi`
--
ALTER TABLE `tabel_transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabel_produk`
--
ALTER TABLE `tabel_produk`
  ADD CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `tabel_kategori` (`kategori_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
