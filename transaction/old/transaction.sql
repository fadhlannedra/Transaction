-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Mar 2019 pada 07.36
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transaction`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `nasabah`
--

CREATE TABLE `nasabah` (
  `accountid` int(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nasabah`
--

INSERT INTO `nasabah` (`accountid`, `name`) VALUES
(1, 'Customer1'),
(2, 'Customer2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(5) NOT NULL,
  `accountid` int(5) NOT NULL,
  `transactiondate` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `debitcreditstatus` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `poin` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `accountid`, `transactiondate`, `description`, `debitcreditstatus`, `amount`, `poin`) VALUES
(1, 1, '2017-01-01', 'Setor Tunai', 'C', 200000, 0),
(2, 1, '2017-01-05', 'Beli Pulsa', 'D', 10000, 0),
(3, 1, '2017-01-06', 'Bayar Listrik', 'D', 70000, 10),
(4, 1, '2017-01-07', 'Tarik Tunai', 'D', 100000, 0),
(5, 1, '2017-02-01', 'Setor Tunai', 'C', 300000, 0),
(6, 1, '2017-02-05', 'Bayar Listrik', 'D', 50000, 0),
(7, 1, '2017-02-15', 'Tarik Tunai', 'D', 50000, 0),
(8, 1, '2017-01-20', 'Beli Pulsa', 'D', 40000, 40),
(9, 1, '2017-02-28', 'Tarik Tunai', 'D', 50000, 0),
(10, 1, '2017-03-01', 'Setor Tunai', 'C', 50000, 0),
(11, 1, '2017-03-07', 'Bayar Listrik', 'D', 125000, 50),
(12, 1, '2017-03-15', 'Beli Pulsa', 'D', 20000, 10);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`accountid`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accountid` (`accountid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `accountid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`accountid`) REFERENCES `nasabah` (`accountid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
